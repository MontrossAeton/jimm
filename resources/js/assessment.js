
$(document).ready(function() {
  $('#calculate-form').on('submit', function(event) {
    event.preventDefault();
    const weight = $('#weight-kg').val();
    let height = $('#height-ft').val();
    height = height / 3.2808
    const bmi = weight / (height * height) || 0;

    $('#result-bmi').css('display', 'block');
    $('#result').text(bmi);
    if (bmi < 18.5) {
      $('#result-word').text('Underweight');
    } else if (bmi <= 24.9){
      $('#result-word').text('Normal weight');
    } else if (bmi <= 29.9) {
      $('#result-word').text('Overweight');
    } else if (bmi >= 30){
      $('#result-word').text('Obesity');
    }
  })
})
