/**
 * Created by   :  Muhammad Yasir
 * Project Name : questionnaire
 * Product Name : PhpStorm
 * Date         : 11-Sep-18 2:13 PM
 * File Name    : question.js
 */
(function (factory) {
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory)
    } else if (typeof define === 'object') {
        factory(require('jquery'))
    } else {
        factory(jQuery)
    }
})(function ($) {
    function Question() {
        this.$questionType = $('.question-type');
        this.$question = $('#questions');
        this.$questionsField = $('#question-type-field');
        this.$addQuestion = $('#add-question');
        this.$deleteQuestion = $('.delete-question');
        this.$addChoice = $('.add-choice');
        this.$deleteChoice = $('.delete-choice');
        this.$questionCount = 0;
        this.$saveQuestions = $('#save-questions');
        this.init();
    }


    Question.prototype = {
        constructor: Question,
        init: function () {
            this.addListener();
        },
        addListener: function () {
            this.$questionType.on('change', $.proxy(this.addFields, this));
            this.$addQuestion.on('click', $.proxy(this.addQuestionField, this));
            this.$deleteQuestion.on('click', $.proxy(this.deleteQuestion, this));
            this.$addChoice.on('click', $.proxy(this.addChoice, this));
            this.$deleteChoice.on('click', $.proxy(this.deleteChoice, this));
            this.$saveQuestions.on('click', $.proxy(this.saveQuestions, this));
        },
        deleteChoice: function (ele) {
            $(ele.currentTarget).closest('.row').remove();
        },
        addChoice: function (ele) {
            var choicesBox = $(ele.currentTarget).parents('.question-box').find('.choices');
            var count = $(choicesBox).find('.row').length * 1;
            if (count === 0) {
                count = 1;
            } else {
                count = count + 1;
            }

            var question_type = $(ele.currentTarget).parents('.question-box').find('.question-type').val();
            var type = 'radio';
            if (question_type === 'MULTIPLE_CHOICE_MULTIPLE') {
                type = 'checkbox';
            }
            var html = this.textFieldWithChoice('Choice ' + count, 'Enter Choice ' + count, 'questions[' + this.$questionCount + '][choices][' + count + ']', type, count);

            $(ele.currentTarget).parents('.question-box').find('.choices').append(html);
            this.$deleteChoice.off('click', $.proxy(this.deleteChoice, this));
            this.$deleteChoice = $('.delete-choice');
            this.$deleteChoice.on('click', $.proxy(this.deleteChoice, this));
        },
        addQuestionField: function () {
            this.$questionCount = this.$questionCount + 1;
            this.$questionType.off('change', $.proxy(this.addFields, this));
            $('#question-type-field').find('.question-type').attr('name', 'questions[' + this.$questionCount + '][question_type]');
            var field = this.$questionsField.html();

            var html = '<div class="question-box">' + field + '</div>';
            this.$question.append(html);
            this.$questionType = $('.question-type');
            this.$questionType.on('change', $.proxy(this.addFields, this));
            this.$deleteQuestion.off('click', $.proxy(this.deleteQuestion, this));
            this.$deleteQuestion = $('.delete-question');
            this.$deleteQuestion.on('click', $.proxy(this.deleteQuestion, this));


        }, deleteQuestion: function (ele) {
            $(ele.currentTarget).parents('.question-box').remove();
        },
        addFields: function (ele) {
            var type = $(ele.currentTarget).val();
            if (type === 'TEXT') {
                this.textQuestion(ele);
            } else if (type === 'MULTIPLE_CHOICE_SINGLE') {
                this.multipleChoiceSingleQuestion(ele);
            } else if (type === 'MULTIPLE_CHOICE_MULTIPLE') {
                this.multipleChoiceMultipleQuestion(ele);
            }

        }, textQuestion: function (ele) {
            var question = this.textField('Question', 'Enter Question', 'questions[' + this.$questionCount + '][question]');
            var answer = this.textField('Answer', 'Enter Answer', 'questions[' + this.$questionCount + '][answer]');
            var html = question + answer;
            $(ele.currentTarget).parents('.question-box').append(html);
        },
        multipleChoiceSingleQuestion: function (ele) {
            var question = this.textField('Question', 'Enter Question', 'questions[' + this.$questionCount + '][question]');
            var html = question + '<div class="choices"></div><div class="form-group row clearfix col-sm-12">\n' +
                '<button type="button" class="btn btn-primary add-choice">Add Choice</button>\n' +
                '</div>';
            $(ele.currentTarget).parents('.question-box').append(html);

            this.$addChoice.off('click', $.proxy(this.addChoice, this));
            this.$addChoice = $('.add-choice');
            this.$addChoice.on('click', $.proxy(this.addChoice, this));

        }, multipleChoiceMultipleQuestion: function (ele) {
            var question = this.textField('Question', 'Enter Question', 'questions[' + this.$questionCount + '][question]');
            var html = question + '<div class="choices"></div><div class="form-group row clearfix col-sm-12">\n' +
                '<button type="button" class="btn btn-primary add-choice">Add Choice</button>\n' +
                '</div>';
            $(ele.currentTarget).parents('.question-box').append(html);

            this.$addChoice.off('click', $.proxy(this.addChoice, this));
            this.$addChoice = $('.add-choice');
            this.$addChoice.on('click', $.proxy(this.addChoice, this));
        }, textField: function (label, placeholder, name) {
            return '<div class="row">\n' +
                '<div class="col-sm-4">\n' +
                '<div class="form-group"> <!-- Full Name -->\n' +
                '<label class="control-label">' + label + '</label>\n' +
                '<input type="text" class="form-control" name="' + name + '" placeholder="' + placeholder + '" value="">\n' +
                '</div>\n' +
                '</div>\n' +
                '</div>';
        }, textFieldWithChoice: function (label, placeholder, name, type, count) {
            return ' <div class="row">\n' +
                '<div class="col-sm-4">\n' +
                '<div class="form-group"> <!-- Full Name -->\n' +
                '<label class="control-label">' + label + '</label>\n' +
                '<input type="text" class="form-control" name="' + name + '" placeholder="' + placeholder + '" value="">\n' +
                '</div>\n' +
                '</div>\n' +
                '<div class="col-sm-1" style="margin-top: 37px">\n' +
                '<input class="form-check-input" type="' + type + '" name="questions[' + this.$questionCount + '][correct][' + count + ']" id="" value="1">\n' +
                '<label class="form-check-label" for="">Correct?</label>\n' +
                '</div>\n' +
                '<div class="col-sm-2" style="margin-top: 31px;">\n' +
                '<button type="button" class="btn btn-danger delete-choice">Delete Choice</button>\n' +
                '</div>\n' +
                '</div>';
        }, saveQuestions: function () {
            var _this = this;
            var form = $('#question-form');
            $.ajax({
                type: "POST",
                url: form.attr('action'),
                data: form.serialize(),
                success: function (data) {
                    _this.submitSuccess(data.message);
                    setTimeout(function () {
                            window.location.href = data.url;
                        },
                        1000);
                },

                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    _this.submitFail(XMLHttpRequest.responseJSON || errorThrown);
                },
            })
        }, submitFail: function (msg, errorClass) {
            this.alert(msg, errorClass, 'alert-danger');
        },
        submitSuccess: function (msg) {
            this.alert(msg, 'alerts', 'alert-success');
        },
        alert: function (msg, targetClass, alertType) {
            if (typeof targetClass === 'undefined') {
                targetClass = 'alerts'
            }
            var $alert = [
                '<div class="alert ' + alertType + ' avatar-alert alert-dismissable">',
                '<button type="button" class="close" data-dismiss="alert">&times;</button>',
                msg,
                '</div>'
            ].join('');

            $('.' + targetClass).empty().html($alert);
        }
    };
    return new Question();
});
