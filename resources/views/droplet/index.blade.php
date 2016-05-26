<!DOCTYPE html>
<html>
    <head>
        <title>CloudTracer</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    </head>
    <body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">CloudTracer - A RayTracer Controller</a>
            </div>
        </div>
    </nav>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Servers list<br><br>
                        @if (Session::has("type"))
                            <div class="alert alert-{{ Session::get('type') }}" role="alert">{{ Session::get('msg') }}</div>
                        @endif
                        <a href="{{ URL::route('droplet-create') }}" class="btn btn-default">Create a server</a>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>IP</th>
                                    <th>RAM</th>
                                    <th>vCPUs</th>
                                    <th>Datacenter</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($droplets as $droplet)
                                    <tr>
                                        <th>{{ $droplet->id }}</th>
                                        <th>{{ $droplet->name }}</th>
                                        @if (count($droplet->networks) > 0)
                                            <th>{{  $droplet->networks[0]->ipAddress }}</th>
                                        @else
                                            <th> Not available yet</th>
                                        @endif
                                        <th>{{ $droplet->memory }}</th>
                                        <th>{{ $droplet->vcpus }}</th>
                                        <th>{{ $droplet->region->name }}</th>
                                    @if($droplet->status == "active")
                                            <th><span class="label label-success"> Online </span></th>
                                        @else
                                            <th><span class="label label-danger"> Offline </span></th>
                                        @endif
                                        <th><a href="{{ URL::route('droplet-refresh', $droplet->id) }}" class="btn btn-default"><i class="fa fa-refresh" aria-hidden="true"></i>
                                            </a>
²
                                            <a onclick="confirm('Are you sure?')" href="{{ URL::route('droplet-delete', $droplet->id) }}" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i>
                                            </a></th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>











    </body>
</html>
