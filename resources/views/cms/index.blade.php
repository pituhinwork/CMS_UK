@extends('layouts.app')

@section('content')
    <div class="container">
        <style type="text/css">
            div.notice {display: none;}
        </style>
        <!--right-->
        <div class="col-md-10" id="col_right">
            <p id="summary"></p>
            <p></p>
            <p>Showing <strong>1</strong> to <strong class="increment">1</strong> of <strong class="increment">1</strong> beacons.</p>
            <p>Total <span class="badge increment">1</span> beacon, <span class="summary_clicks badge">1</span> click.</p>

            <div class="panel panel-default"><div class="panel-body"><form class="form-inline" role="form" id="new_url_form_modified" action="javascript:add_link();" method="get">
                        <div class="form-group">
                            <p> All the following can be changed later under Actions... Edit </p>
                            <label for="add-name-modified"><strong>Name</strong></label> Used only to identify in EddystoneCMS e.g. Shop front window beacon
                            <br>
                            <input type="text" id="add-name-modified" name="beaconname" class="form-control" size="90">
                            <input type="hidden" id="nonce-add" name="nonce-add" value="f8f8a1051c"></div>
                        <br>
                        <div class="form-group">
                            <label for="add-title-modified">
                                <strong>Title</strong>
                            </label>  The main message for the smartphone notification e.g. The Green Cafe
                            <br>
                            <input type="text" id="add-title-modified" name="title" class="form-control" size="90"></div>
                        <br>
                        <div class="form-group">
                            <label for="add-description-modified">
                                <strong>Description</strong>
                            </label>  Sometimes used as the 2nd line of the smartphone notification e.g. Click to see the cafe menu
                            <br>
                            <input type="text" id="add-description-modified" name="description" class="form-control" size="90">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="add-html-modified"><strong>Web site text or HTML</strong></label>  Seen when user clicks on the notification e.g. Our menu today is ...
                            <br>
                            <input type="text" id="add-html-modified" name="beaconhtml" class="form-control" size="90">
                        </div>
                        <br>
                        <button type="submit" id="add-button-modified" class="btn btn-primary ladda-button" data-style="zoom-in" data-size="l">
                            <span class="ladda-label">Add a Beacon</span></button></form>
                    <div id="feedback-modified" style="display:none">

                    </div>
                </div>
            </div>

            <div id="shareboxes" style="display:none;">

                <style type="text/css">
                    div#copybox, div#sharebox {display: none;}
                </style>

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

            <style type="text/css">
                //tfoot, tfoot tr {display: none;}
                tfoot {display: none;}
            </style>
            <table class="table datatable-basic table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th class="footable-visible footable-first-column">Email</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Registered</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                {{--@foreach($users as $user)--}}
                {{--<tr>--}}
                {{--<td>{{ $user->email }}</td>--}}
                {{--<td>{{ $user->firstname }}</td>--}}
                {{--<td>{{ $user->lastname }}</td>--}}
                {{--<td>{{ $user->created_at }}</td>--}}
                {{--<td class="text-center">--}}
                {{--<a class="btn btn-xs btn-info" href="{{ route('users.edit', $user->id) }}"><i class="icon-compose"></i></a>--}}
                {{--<form method="post" action="{{ route('users.destroy', $user->id) }}" style="display: inline-block;">--}}
                {{--<input name="_method" type="hidden" value="DELETE">--}}
                {{--{{ csrf_field() }}--}}
                {{--<button class="btn btn-xs btn-danger btn-confirm">--}}
                {{--<i class="icon-bin"></i>--}}
                {{--</button>--}}
                {{--</form>--}}
                {{--</td>--}}
                {{--</tr>--}}
                {{--@endforeach--}}
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