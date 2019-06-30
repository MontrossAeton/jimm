@extends('layouts.app')

@section('content')
<div class="main">
    <div class="section section-buttons">
        <div class="container">
            <div class="tim-title">
                <div class="row panel pb-4">
                    <div class="col">
                        <h2 class="text-center">Assessment</h2>
                    </div>
                </div>
                <div class="row pt-4">
                    <form id="calculate-form" class="col-md-6 offset-md-3 text-center">
                        <div class="form-group">
                            <input type="number" step="any" class="form-control" min=1 id="weight-kg" required placeholder="Weight in Kg">
                        </div>
                        <div class="form-group">
                            <input type="number" step="any" class="form-control" min=1 id="height-ft" required placeholder="Height in Feet">
                        </div>
                        <button type="submit" class="btn btn-primary">Calculate now</button>
                    </form>
                </div>
                <div class="row pt-4">
                    <div class="col-md-6 offset-md-3 text-center">
                        <span id="result-bmi">
                            <h3>Result</h3>
                            <h4>Your bmi is: <span id="result"></span> </h4>
                            <h4>Category: <span id="result-word"></span> </h4>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('posts.create-modal')

@endsection

