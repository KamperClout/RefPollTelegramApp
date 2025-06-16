{{--@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-min.js"></script>
    <link href="https://unpkg.com/survey-creator@1.8.77/survey-creator.min.css" rel="stylesheet"/>
    <script src="https://unpkg.com/survey-jquery@1.8.77/survey.jquery.min.js"></script>
    <script src="https://unpkg.com/survey-creator@1.8.77/survey-creator.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof SurveyCreator === 'undefined') {
                alert('SurveyCreator не загружен! Проверьте подключение скриптов.');
                return;
            }
            const creator = new SurveyCreator('surveyCreatorContainer');
            let initialJson = document.getElementById('survey_json').value;
            if (initialJson) {
                try {
                    creator.text = initialJson;
                } catch (e) {}
            }
            document.getElementById('saveSurvey').onclick = function () {
                document.getElementById('survey_json').value = creator.text;
            };
        });
    </script>
@endpush--}}
