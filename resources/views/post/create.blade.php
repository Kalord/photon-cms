@extends('layouts.admin')

@section('title', 'Создание публикации')

@section('specific_css')
<link rel="stylesheet" href="/assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />
<link rel="stylesheet" href="/assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
<link rel="stylesheet" href="/assets/vendor/select2/select2.css" />
<link rel="stylesheet" href="/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
<link rel="stylesheet" href="/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
<link rel="stylesheet" href="/assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
<link rel="stylesheet" href="/assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
<link rel="stylesheet" href="/assets/vendor/dropzone/css/basic.css" />
<link rel="stylesheet" href="/assets/vendor/dropzone/css/dropzone.css" />
<link rel="stylesheet" href="/assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
<link rel="stylesheet" href="/assets/vendor/summernote/summernote.css" />
<link rel="stylesheet" href="/assets/vendor/summernote/summernote-bs3.css" />
<link rel="stylesheet" href="/assets/vendor/codemirror/lib/codemirror.css" />
<link rel="stylesheet" href="/assets/vendor/codemirror/theme/monokai.css" />
@endsection

@section('content')
<section class="panel">
    <header class="panel-heading">
        <h2 class="panel-title">Публикация</h2>
    </header>
    <div class="panel-body">
        <form class="form-horizontal form-bordered" method="get">
            <div class="form-group">
                <label class="col-md-3 control-label" for="inputDefault">Заголовок</label>
                <div class="col-md-6">
                    <input type="text" class="form-control input-title" id="inputDefault">
                </div>
            </div>
            <div class="form-group">
				<label class="col-md-3 control-label" for="textareaDefault">Описание</label>
				<div class="col-md-6">
					<textarea class="form-control description" rows="3" data-plugin-maxlength maxlength="160"></textarea>
					<p>
						<code>max-length</code> set to 160.
					</p>
                </div>
			</div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="inputDefault">Ключевые слова</label>
                <div class="col-md-6">
                    <input type="text" class="form-control keywords" id="inputDefault">
                </div>
            </div>
            <div class="form-group">
			<label class="col-md-3 control-label">Категория</label>
			<div class="col-md-6">
				<select class="form-control categories" data-plugin-multiselect id="ms_example1">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
				</select>
			</div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Обложка</label>
                <div class="col-md-6">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="input-append">
                            <div class="uneditable-input">
                                <i class="fa fa-file fileupload-exists"></i>
                                <span class="fileupload-preview"></span>
                            </div>
                            <span class="btn btn-default btn-file">
                                <span class="fileupload-exists">Change</span>
                                <span class="fileupload-new">Select file</span>
                                <input type="file" class="main-img">
                            </span>
                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="inputDefault">Описание обложки</label>
                <div class="col-md-6">
                    <input type="text" class="form-control alt-main-img" id="inputDefault">
                </div>
            </div>
        </form>
    </div>
</section>


<div class="row">
    <div class="col-xs-12">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">Редактор</h2>
            </header>
            <div class="panel-body">
                <form class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Summernote</label>
                        <div class="col-md-9">
                            <div class="summernote" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }' 
                        </div> 
                    </div> 
                </div> 
            </form> 
            </div> 
        </section> 
    </div> 
</div>

{{@csrf_field()}}

<div class="alert alert-danger error-message" style="display: none;"></div>
<a class="btn btn-primary">Предпросмотр</a>
<a class="btn btn-primary btn-save" data-status="1">Опубликовать в черновик</a>
<a class="btn btn-primary btn-save" data-status="2">Опубликовать</a>
@endsection 


@section('specific_js')
    <script src="/assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
    <script src="/assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
    <script src="/assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
    <script src="/assets/vendor/select2/select2.js"></script>
    <script src="/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
    <script src="/assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
    <script src="/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <script src="/assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script src="/assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script src="/assets/vendor/fuelux/js/spinner.js"></script>
    <script src="/assets/vendor/dropzone/dropzone.js"></script>
    <script src="/assets/vendor/bootstrap-markdown/js/markdown.js"></script>
    <script src="/assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
    <script src="/assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
    <script src="/assets/vendor/codemirror/lib/codemirror.js"></script>
    <script src="/assets/vendor/codemirror/addon/selection/active-line.js"></script>
    <script src="/assets/vendor/codemirror/addon/edit/matchbrackets.js"></script>
    <script src="/assets/vendor/codemirror/mode/javascript/javascript.js"></script>
    <script src="/assets/vendor/codemirror/mode/xml/xml.js"></script>
    <script src="/assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
    <script src="/assets/vendor/codemirror/mode/css/css.js"></script>
    <script src="/assets/vendor/summernote/summernote.js"></script>
    <script src="/assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
    <script src="/assets/vendor/ios7-switch/ios7-switch.js"></script>
    <script src="/assets/vendor/bootstrap-confirmation/bootstrap-confirmation.js"></script>
@endsection