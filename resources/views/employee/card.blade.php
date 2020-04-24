<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Card</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body onload="window.print()">
    <main>
        <div class="card text-center" style="width: 18rem;">
	  		<img style="height: 200px; width: 200px; background-color: #EFEFEF; margin: 20px;" src="/images/{{$employee->avatar}}" class="card-img-top rounded-circle mx-auto d-block" alt="">
			<div class="card-body">
				<h4 class="card-title">{{$employee->firstname}} {{$employee->lastname}}</h4>
				<h5 class="card-text">{{$employee->job->name ?? null}}</h5>
				{!! QrCode::size(175)->generate($employee->slug); !!}
				<h6 class="card-text">{{$employee->slug}}</h6>
			</div>
		</div>
	</main>
</body>
