@csrf  

<script>

    $(document).on('click', '.js-image-link', function () {
        var url  = $(this).attr('src');
        var args = top.tinymce.activeEditor.windowManager.getParams();
        var input  = args.input;
        args.window.document.getElementById(input).value = url;
        top.tinymce.activeEditor.windowManager.close();
    });



    $(function(){
        $( '#slidepro' ).sliderPro({
			width: 200,
			height: 250,
			arrows: true,//左右箭頭
			visibleSize: '50%', //可見比例
			autoplay: false, //是否自動播放
			buttons: false,  //下方點點圖是否顯示
		});

		// instantiate fancybox when a link is clicked
		$( ".slider-pro" ).each(function(){
			var slider = $( this );

			slider.find( ".sp-image" ).parent( "a" ).on( "click", function( event ) {
				event.preventDefault();
			
				if ( slider.hasClass( "sp-swiping" ) === false ) {
					var sliderInstance = slider.data( "sliderPro" ),
						isAutoplay = sliderInstance.settings.autoplay;

					$.fancybox.open( slider.find( ".sp-image" ).parent( "a" ), {
						index: $( this ).parents( ".sp-slide" ).index(),
						afterShow: function() {
							if ( isAutoplay === true ) {
								sliderInstance.settings.autoplay = false;
								sliderInstance.stopAutoplay();
							}
						},
						afterClose: function() {
							if ( isAutoplay === true ) {
								sliderInstance.settings.autoplay = true;
								sliderInstance.startAutoplay();
							}
						}
							
					});
				}
			});
		});

        $('#menu_id').change(function(){
            var menu_id=$('#menu_id').val();

            $.ajax({
                url:'/manager/products/menu',
                type:'post',
                async:false,
                data:{'menu_id':menu_id,'_token':'{{ csrf_token() }}'},
                success:function(data){
                    if(data){
                       $('#sub_menu').empty();
                       $('#sub_menu').append(data);
                    }
                    //console.log(data);
                },
                error:function(e){
                }
            });
        });

    
       
    });



    tinymce.init({
        selector: '#tinymce',
        automatic_uploads: false,
        //image_list: "/manager/products/tinymceimg/{{ $product->p_id ?? '' }}",
        images_upload_url: '/manager/products/tinymceupload', //上傳圖片網址，有用到images_upload_handler，這裡一定要設
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;
            var token = '{{ csrf_token() }}';

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '/manager/products/tinymceupload/{{ $product->p_id ?? '' }}'); //設定post的網址
            xhr.setRequestHeader('X-CSRF-TOKEN', token);
            
            xhr.onload = function() {
            var json;

            if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }
        
            json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }

            success(json.location);
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
        },
        file_picker_types: 'image',
        file_picker_callback: function (callback, value, meta) {
            //要先模拟出一个input用于上传本地文件
            var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', '.jpg,.jpeg');
                //你可以给input加accept属性来限制上传的文件类型
                //例如：input.setAttribute('accept', '.jpg,.png');
                input.click();
                input.onchange = function() {
                    var file = this.files[0];
                    var token = '{{ csrf_token() }}';

                    var xhr, formData;
                    console.log(file.name);
                    xhr = new XMLHttpRequest();
                    xhr.withCredentials = false;
                    xhr.open('POST', '/manager/products/tinymceupload/{{ $product->p_id ?? '' }}');
                    xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    xhr.onload = function() {
                        var json;
                        if (xhr.status != 200) {
                            failure('HTTP Error: ' + xhr.status);
                            return;
                        }
                        json = JSON.parse(xhr.responseText);
                        if (!json || typeof json.location != 'string') {
                            failure('Invalid JSON: ' + xhr.responseText);
                            return;
                        }
                        callback(json.location);
                    };
                    formData = new FormData();
                    formData.append('file', file, file.name );
                    xhr.send(formData);
                }
        },
        menubar: false,//上方選單是否顯示，預設true
        //toolbar_drawer: 'sliding',  //floating向下展開 sliding下向滑行 
        toolbar1: "undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect ",

        toolbar2: "numlist bullist  pagebreak| alignleft aligncenter alignright alignjustify |  outdent indent |a11ycheck ltr rtl ",

        toolbar3 :" forecolor backcolor   |  fullscreen  preview  | showcomments addcomment | image  link  codesample  charmap emoticons ImgManagerButton",
        setup: function (editor) {

            editor.ui.registry.addButton('ImgManagerButton', {
                text: 'ImgManager',
                onAction: function (_) {
                    $.colorbox({
                        width:"50%",
                        height:"70%",
                        iframe: true,
                        href:"/manager/products/tinymceimgmanager/{{ $product->p_id ?? '' }}",

                    });
                }
            });
        },
        
       plugins: "preview    importcss tinydrive searchreplace autolink autosave  directionality  visualblocks visualchars fullscreen image  link codesample table charmap hr pagebreak nonbreaking  toc insertdatetime advlist lists  wordcount   imagetools textpattern noneditable help    charmap  quickbars  emoticons ",

       
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
        ],

        height: 600, //textarea高度
        //language: 'zh_TW',  //調整語系
        //language_url : "{{ asset('js/tinymce/langs/zh_TW.js') }}"   //語系檔案位置(官網下載)
        tinydrive_token_provider: "{{ asset('js/tinymce/jwt.php') }}",  //圖片上傳會用到的token
        image_advtab: false,
        
    });

    function on_delete(id){
        
        $.ajax({
            url:'/manager/products/deleteMultipleImg/'+id,
            type:'post',
            async:false,
            data:{'_token':'{{ csrf_token() }}','_method':'DELETE'},
            success:function(data){
                if(data==1){
                    location.reload();
                }
            },
            error:function(e){
            }
        });
    }

</script>


<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">商品名稱<span class="required">*</span>
    </label>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <input type="text" id=""  name="name"" class="form-control" value='{{ old("name") ?? $product->name }}'>
        <div style='color:#FF0000;'>{{ $errors->first('name') }}</div>
        <div class="alert">{{ $errors->first('name') }}</div>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">商品標題<span class="required">*</span>
    </label>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <input type="text" id=""  name="title" class="form-control" value='{{ old("title") ?? $product->title }}'>
        <div style='color:#FF0000;'>{{ $errors->first('title') }}</div>
    </div>
</div>
<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="main_img">商品主圖 <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            @if ($product->img)
                <div class="col12">
                    <img src="{{ asset('storage/'.$product->img) }}" alt="">
                </div>
            @endif
            
            <div id="inputBox">
                <input type="file"  name="upload_img" >
                <div style='color:#FF0000;'>{{ $errors->first('upload_img.*') }}</div>
            </div>
           
        </div>
</div>

<div class="form-group">
   
        <div class="col12">
                
        </div>
</div>
<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="main_img">商品組圖 <span class="required">*</span></label>
        <div class="col-md-9 col-sm-6 col-xs-12">
                <div id="slidepro" class="slider-pro">
                    <div class="sp-slides">
                        @if(!empty($multiple_imgs))
                        @foreach ($multiple_imgs as $multiple_img)
                            <div class="sp-slide">
                                <a href="{{ asset('storage/'.$multiple_img->img) }}">
                                    <img class="sp-image" src="{{ asset('storage/'.$multiple_img->img) }}"/>
                                </a>
                                <p class="sp-layer sp-black sp-padding"
                                    data-position="bottomLeft" data-vertical="0" data-width="100%"
                                    data-show-transition="up">
                                    <button type='button' onClick='on_delete({{ $multiple_img->id }});' class="btn btn-danger">刪除</button>
                                </p>
                
                            </div>
                        @endforeach
                        @endif
                    </div>
                </div>
        </div>
</div>
<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="main_img">商品組圖 <span class="required">*</span></label>
        <div class="col-md-9 col-sm-6 col-xs-12">
            <div id="inputBox">
                <input type="file"  name="multiple_img[]" multiple>
                <div style='color:#FF0000;'>{{ $errors->first('multiple_img.*') }}</div>
            </div>
           
        </div>
</div>
<div class="form-group row">
    <label class="control-label col-md-3 col-sm-3 ">主類別</label>
    <div class="col-md-3 col-sm-6 ">
        <select class="form-control" name='menu_id' id='menu_id'>
            <option value="">請選擇</option>
            @foreach($mainmenus as $mainmenu)
                <option value='{{ $mainmenu->menu_id }}' {{ isset($choose_menu_id) && $choose_menu_id==$mainmenu->menu_id ? 'selected': '' }} >{{ $mainmenu->name }}</option>
            @endforeach
        </select>
        <div style='color:#FF0000;'>{{ $errors->first('sub_id') }}</div>
    </div>
</div>


<div class="form-group row">
    <label class="control-label col-md-3 col-sm-3 ">子類別</label>
    <div class="col-md-3 col-sm-6 ">
        <select class="form-control" name='sub_id' id='sub_menu'>
            <option value="">請選擇</option>
            @isset($submenus) 
                
                @foreach ($submenus as $submenu)
                    <option value="{{ $submenu['sub_id'] }}" {{ isset($choose_sub_id) && $choose_sub_id==$submenu['sub_id'] ? 'selected': '' }} >{{ $submenu['name'] }}</option>   
                @endforeach     
            @endisset
        </select>
        <div style='color:#FF0000;'>{{ $errors->first('sub_id') }}</div>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">價格<span class="required">*</span>
    </label>
    <div class="col-md-1 col-sm-6 col-xs-12">
        <input type="text" id=""  name="price"" class="form-control" value='{{ old("price") ?? $product->price }}'>
        <div style='color:#FF0000;'>{{ $errors->first('price') }}</div>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">庫存<span class="required">*</span>
    </label>
    <div class="col-md-1 col-sm-6 col-xs-12">
        <input type="text" id=""  name="stock"" class="form-control" value='{{ old("stock") ?? $product->stock }}'>
        <div style='color:#FF0000;'>{{ $errors->first('stock') }}</div>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">商品描述<span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <textarea name='desc' style="width:100%;height:150px;">{{ old("desc") ?? $product->desc }}</textarea>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">商品內容<span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <textarea id="tinymce" name='content' class="form-control" >{!! old("content") ?? $product->content !!}</textarea>
        <input id="my-file" type="file" name="my-file" style="display: none;" onchange="" />
        <!--<form id="my_form" action="/upload/" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
            <input name="image" type="file" onchange="$('#my_form').submit();this.value='';" style="display: none;">
        </form>-->
    </div>
</div>


<div class="ln_solid"></div>
<div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        <button type='submit' class="btn btn-success" >Submit</button>
    </div>
</div>

