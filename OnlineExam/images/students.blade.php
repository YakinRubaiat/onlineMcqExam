<div class="row">
	@forelse ($students as $student)
		<?php
		//Choose a random image from images/demo_profiles/ -> if the student has no image
		$imagesDir = public_path().'/images/demo_profiles/';
		$images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
		$random_img = basename($images[array_rand($images)]);
		?>

		<div class="col-md-3 col-sm-6 portfolio-item mx-auto">
			<div class="student-single">
				<a class="portfolio-link" href="{{ route('student', $student->student_id) }}">
					<div class="portfolio-hover">
						<div class="portfolio-hover-content">
							<i class="fa fa-plus fa-3x"></i>
						</div>
					</div>
					@php
					if ($student->image != NULL && File::exists(public_path('images/students/'.$student->image))) {
						$image = asset('images/students/'.$student->image);
					}else{
						$image = asset('images/demo_profiles/'.$random_img);
					}
					@endphp
					<img class="img img-responsive img-fluid" src="{{ $image }}" alt="">

				</a>
				<div class="portfolio-caption">
					<h4>{{ $student->name }}</h4>
					<p>
						Faculty Of {{ shortToFullFacultyName($student->faculty) }}
					</p>
					<p><strong>ID</strong> - {{ $student->student_id }}</p>
					<p><strong>Registration No</strong> - {{ $student->registration }}</p>

					@if ($student->gender == "male" || $student->gender == "Male")
						<p>
							<strong>Student's Phone : </strong> <a href="tel:{{ addZeroToPhone($student->students_mobile) }}">{{ addZeroToPhone($student->students_mobile) }}</a>
						</p>
					@endif
					@if (Auth::guard('admin')->check())
						@if ($student->gender == "female" || $student->gender == "Female")
							<p>
								<strong>Phone : </strong> <a href="tel:{{ addZeroToPhone($student->students_mobile) }}">{{ addZeroToPhone($student->students_mobile) }}</a>
							</p>
						@endif
						<p>
							<strong>Guardian's Phone : </strong> <a href="tel:{{ addZeroToPhone($student->guardians_mobile) }}">{{ addZeroToPhone($student->guardians_mobile) }}</a>
						</p>
					@endif

					<a href="{{ route('student', $student->student_id) }}" class="btn btn-warning btn-sm">View More</a>
				</div>
			</div>


		</div>
	@empty
		<div class="col-4 mx-auto" style="margin-bottom: 15%"><div class="alert alert-danger" role="alert">
			<strong>Sorry !!!</strong> No students are there..!! Please wait.. It'll be updated immediately
		</div>

	@endforelse



</div>
<div class="text-center">
	{{ $students->links() }}
</div>
</div>
