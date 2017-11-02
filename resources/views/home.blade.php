@extends('layouts.app')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success fade in alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="container">
        <!--right-->
        <div class="col-md-10" id="col_right">
            <p id="summary"></p>
            <p></p>
            <p>Showing <strong>1</strong> to <strong class="increment">1</strong> of <strong class="increment">1</strong> beacons.</p>
            <p>Total <span class="badge increment">{{$beacon}}</span> beacon, <span class="summary_clicks badge">{{$click}}</span> click.</p>

            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-inline" role="form" id="add_beacon" action="{{route('cms.add')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <p> All the following can be changed later under Actions... Edit </p>
                            <label for="add-name-modified"><strong>Name</strong></label> Used only to identify in EddystoneCMS e.g. Shop front window beacon
                            <br>
                            <input type="text" id="name" name="name" class="form-control" size="90">
                            <input type="hidden" id="nonce-add" name="nonce-add" value="f8f8a1051c"></div>
                        <br>
                        <div class="form-group">
                            <label for="add-title-modified">
                                <strong>Title</strong>
                            </label>  The main message for the smartphone notification e.g. The Green Cafe
                            <br>
                            <input type="text" id="title" name="title" class="form-control" size="90"></div>
                        <br>
                        <div class="form-group">
                            <label for="add-description-modified">
                                <strong>Description</strong>
                            </label>  Sometimes used as the 2nd line of the smartphone notification e.g. Click to see the cafe menu
                            <br>
                            <input type="text" id="description" name="description" class="form-control" size="90" maxlength="40">
                        </div>
                        <br>
                        <div class="form-group" style="width: 662px">
                            <label for="add-html-modified"><strong>Web site text or HTML</strong></label>  Seen when user clicks on the notification e.g. Our menu today is ...
                            <br>
                            <div id="summernote" name="summernote" ></div>
                            <input type="hidden" id="text" name="text">
                        </div>
                        <br>
                        <button type="submit" id="add-button-modified" class="btn btn-primary ladda-button" data-style="zoom-in" data-size="l" style="margin-top:20px">
                            <span class="ladda-label">Add a Beacon</span></button>
                    </form>
                    <div id="feedback-modified" style="display:none">

                    </div>
                </div>
            </div>

            <div id="shareboxes" style="display:none;">


                <div id="copybox" class="share">
                    <h2 class="panel-title">Put this short URL in your beacon</h2>			<p><input id="copylink" class="text" size="32" value=""></p>
                    <p><small>Long link: <a id="origlink" href=""></a></small>
                        <br><small>Stats: <a id="statlink" href="+">+</a></small>
                        <input type="hidden" id="titlelink" value="">
                    </p>
                </div>


                <div id="sharebox" class="share">
                    <h2 class="panel-title">Quick Share</h2>			<div id="tweet">
                        <span id="charcount" class="">140</span>
                        <textarea id="tweet_body"></textarea>
                    </div>
                    <p id="share_links">Share with
                        <a id="share_tw" href="http://twitter.com/home?status=" title="Tweet this!" onclick="share('tw');return false">Twitter</a>
                        <a id="share_fb" href="http://www.facebook.com/share.php?u=" title="Share on Facebook" onclick="share('fb');return false;">Facebook</a>
                        <a id="share_ff" href="http://friendfeed.com/share/bookmarklet/frame#title=" title="Share on Friendfeed" onclick="share('ff');return false;">FriendFeed</a>
                    </p>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div id="copybox_modified" class="panel panel-primary">
                            <div class="panel-heading">
                                <h2 class="panel-title">Put this short URL in your beacon</h2>		  </div>
                            <div class="panel-body fixed-panel">
                                <form role="form">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="copylink-modified" value="">
                                    </div>
                                </form>
                                <p><small>Long link: <a id="origlink-modified" href="" target="_blank"></a></small>
                                    <br><small>Stats: <a id="statlink-modified" href="+">http://:///+</a></small>
                                    <input type="hidden" id="titlelink-modified" value="">
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-6">

                    </div><!-- col-sm -->
                </div><!-- row -->

            </div>
            <form method="POST" id="my_form" action="{{route('link.edit')}}">{{csrf_field()}}
                <input type="hidden" id="name_table1" name="name_table1" value="aaa" class="form-control" size="90"  style="background-color: white">
        <input type="hidden" id="title_table1" name="title_table1" class="form-control" size="90" value="aaa" style="background-color: white" form="my_form">
        <input type="hidden" id="description_table1" name="description_table1" class="form-control" size="90" value="aaa" style="background-color: white" form="my_form" maxlength="40">
        <input type="hidden" id="text_table1" name="text_table1" class="form-control" size="90" value="aaa" style="background-color: white" form="my_form">
        <input type="hidden" id="id_table1" name="id_table1" form="my_form">
            </form>
            <table class="table datatable-basic table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>Short Url</th>
                    <th>Name and Long Url</th>
                    <th>Date</th>
                    <th>Clicks</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($links as $link)
                <tr>
                 <td hidden>{{$link->name}}</td>
                 <td hidden>{{$link->title}}</td>
                 <td hidden>{{$link->description}}</td>
                 <td hidden>{{$link->text}}</td>
                    <td hidden>{{$link->id}}</td>
                <td><a href="{{ route('link.show', $link->id) }}">{{ "http://localhost/cms/".$link->url }}</a></td>
                <td>
                    <input type="hidden" class="link" id="link" name="link" value="{{$link}}">
                    @if($link->name)
                        <div>
                            <a href="{{ route('link.show', $link->id) }}" style="color : #3097D1;">{{ $link->name }}</a>
                        </div>
                        <small>
                            <a href="{{ route('link.show', $link->id) }}">{{ "http://localhost/cms/".$link->url."/index.html" }}</a>
                        </small>
                    @else
                            <div>
                                <a href="{{ route('link.show', $link->id) }}" style="color : #3097D1;">https://localhost/htmltemplate/index.html</a>
                            </div>
                            <small>
                                <a href="{{ route('link.show', $link->id) }}">{{ "http://localhost/cms/".$link->url."/index.html" }}</a>
                            </small>
                    @endif
                </td>
                <td>{{ $link->created_at }}</td>
                <td>{{ $link->clicks}}</td>
                <td class="text-center">
                    <button class="stats"><a href="{{ url('/stats/'.$link->id ) }}"><i class="glyphicon glyphicon-stats"></i></a></button>

                    <button class="editbtn"><i class="glyphicon glyphicon-edit"></i></button>
                    {!! Form::open(['method' => 'DELETE','route' => ['link.destroy', $link->id],'style'=>'display:inline']) !!}
                    {{ Form::button('<a > <i class="glyphicon glyphicon-trash"></i></a>', ['type' => 'submit', 'class' => ''] )  }}

                    {!! Form::close() !!}

                </td>
                </tr>
                @endforeach
                </tbody>
            </table>

        </div><!--/right-->
    </div>

@endsection

@section('prescripts')
    <script src="{{ asset('admin/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script src="{{ asset('admin/js/plugins/forms/selects/select2.min.js')}}"></script>

@endsection

@section('postscripts')
    <script src="{{ asset('admin/js/pages/datatables_basic.js')}}"></script>
@endsection