(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://roctracker.dev:8888/',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"api\/user","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard\/details\/college\/{id}","name":"view_college_details","action":"App\Http\Controllers\CollegeController@getCollegeDetails"},{"host":null,"methods":["GET","HEAD"],"uri":"advanced\/search","name":"advanced_search","action":"App\Http\Controllers\HomeController@getAdvancedSearch"},{"host":null,"methods":["POST"],"uri":"advanced\/search\/search","name":"search","action":"App\Http\Controllers\FunctionalController@search"},{"host":null,"methods":["GET","HEAD"],"uri":"profile","name":"profile","action":"App\Http\Controllers\HomeController@getProfile"},{"host":null,"methods":["POST"],"uri":"profile\/save\/profile","name":"profile_save","action":"App\Http\Controllers\UserController@postSaveProfile"},{"host":null,"methods":["GET","HEAD"],"uri":"college","name":"colleges","action":"App\Http\Controllers\HomeController@getColleges"},{"host":null,"methods":["GET","HEAD"],"uri":"college\/view\/{id}","name":"view_colleges","action":"App\Http\Controllers\HomeController@getCollegeTimeline"},{"host":null,"methods":["GET","HEAD"],"uri":"college\/change\/{id}","name":"change_colleges","action":"App\Http\Controllers\HomeController@getChangeColleges"},{"host":null,"methods":["POST"],"uri":"college\/change\/{id}\/check","name":"save_change_colleges","action":"App\Http\Controllers\CollegeController@postChangeCollege"},{"host":null,"methods":["GET","HEAD"],"uri":"college\/change\/{id}\/check\/selection\/{collegename?}\/{collegelocation?}","name":"change_college_assessors","action":"App\Http\Controllers\CollegeController@getChangeAssessorsSelection"},{"host":null,"methods":["GET","HEAD"],"uri":"college\/add","name":"add_college","action":"App\Http\Controllers\HomeController@getAddNewCollege"},{"host":null,"methods":["POST"],"uri":"college\/add\/save","name":"save_new_college","action":"App\Http\Controllers\CollegeController@postNewCollege"},{"host":null,"methods":["GET","HEAD"],"uri":"college\/save\/assessor\/{id}\/{collegeid}","name":"ajax_save_college_by_selection","action":"App\Http\Controllers\FunctionalController@ajaxSaveAssessorToCollege"},{"host":null,"methods":["GET","HEAD"],"uri":"college\/save\/{id}\/{name}","name":"ajax_save_college","action":"App\Http\Controllers\FunctionalController@ajaxSaveCollege"},{"host":null,"methods":["GET","HEAD"],"uri":"teamleaders","name":"teamleaders","action":"App\Http\Controllers\HomeController@getTeamleaders"},{"host":null,"methods":["GET","HEAD"],"uri":"teamleader\/view\/{id}","name":"view_teamleaders","action":"App\Http\Controllers\HomeController@getTeamleaderTimeline"},{"host":null,"methods":["GET","HEAD"],"uri":"teamleader\/change\/{id}","name":"change_teamleaders","action":"App\Http\Controllers\HomeController@getChangeTeamleader"},{"host":null,"methods":["POST"],"uri":"teamleader\/change\/{id}\/check","name":"save_change_teamleaders","action":"App\Http\Controllers\TeamleaderController@postChangeTeamleader"},{"host":null,"methods":["GET","HEAD"],"uri":"teamleader\/add","name":"add_teamleader","action":"App\Http\Controllers\HomeController@getAddTeamleader"},{"host":null,"methods":["POST"],"uri":"teamleader\/add\/manual\/save\/{count?}","name":"add_teamleader_manual_save","action":"App\Http\Controllers\TeamleaderController@postAddTeamleaderManual"},{"host":null,"methods":["GET","HEAD"],"uri":"teamleader\/add\/manual\/exchange","name":"add_teamleader_change_save","action":"App\Http\Controllers\TeamleaderController@getChangeTeamleaderManual"},{"host":null,"methods":["POST"],"uri":"teamleader\/add\/manual\/exchange\/save\/{count?}","name":"add_teamleader_change_save_exchange","action":"App\Http\Controllers\TeamleaderController@postChangeTeamleaderManual"},{"host":null,"methods":["GET","HEAD"],"uri":"teamleader\/save\/{id}\/{name}","name":"ajax_save_teamleader","action":"App\Http\Controllers\FunctionalController@ajaxSaveTeamleader"},{"host":null,"methods":["GET","HEAD"],"uri":"assessors","name":"assessors","action":"App\Http\Controllers\HomeController@getAssessors"},{"host":null,"methods":["GET","HEAD"],"uri":"assessor\/profile\/{id}","name":"view_assessor_profiel","action":"App\Http\Controllers\HomeController@getAssessorProfile"},{"host":null,"methods":["GET","HEAD"],"uri":"assessor\/view\/{id}","name":"view_assessor","action":"App\Http\Controllers\HomeController@getAssessorTimeline"},{"host":null,"methods":["GET","HEAD"],"uri":"assessor\/change\/{id}","name":"change_assessor","action":"App\Http\Controllers\HomeController@getChangeAssessor"},{"host":null,"methods":["POST"],"uri":"assessor\/change\/{id}\/check","name":"save_change_assessor","action":"App\Http\Controllers\AssessorController@postChangeAssessor"},{"host":null,"methods":["GET","HEAD"],"uri":"assessor\/add","name":"add_assessor","action":"App\Http\Controllers\HomeController@getAddAssessor"},{"host":null,"methods":["GET","HEAD"],"uri":"assessor\/add\/manual","name":"add_assessor_manual","action":"App\Http\Controllers\HomeController@getAddAssessorManual"},{"host":null,"methods":["POST"],"uri":"assessor\/add\/manual\/save\/{count?}","name":"add_assessor_manual_save","action":"App\Http\Controllers\AssessorController@postAddAssessorManual"},{"host":null,"methods":["GET","HEAD"],"uri":"assessor\/add\/automatic","name":"add_assessor_automatic","action":"App\Http\Controllers\HomeController@getAddAssessorAutomatic"},{"host":null,"methods":["GET","HEAD"],"uri":"assessor\/excel\/layout\/download","name":"download_excel_assessor_layout","action":"App\Http\Controllers\FunctionalController@downloadExcelAssessorLayout"},{"host":null,"methods":["POST"],"uri":"assessor\/add\/automatic\/save","name":"add_assessor_automatic_save","action":"App\Http\Controllers\AssessorController@postAddAssessorAutomatic"},{"host":null,"methods":["GET","HEAD"],"uri":"assessor\/add\/automatic\/undo\/{id}","name":"add_assessor_automatic_undo","action":"App\Http\Controllers\AssessorController@getUndoAssessorAutomatic"},{"host":null,"methods":["GET","HEAD"],"uri":"maintenance\/overview","name":"maintenance_assessor","action":"App\Http\Controllers\HomeController@getAssessorMaintenance"},{"host":null,"methods":["GET","HEAD"],"uri":"maintenance\/groups","name":"maintenance_assessor_groups","action":"App\Http\Controllers\HomeController@getAssessorMaintenanceGroup"},{"host":null,"methods":["GET","HEAD"],"uri":"maintenance\/groups\/add","name":"add_new_assessor_groups","action":"App\Http\Controllers\AssessorMaintenanceController@getMakeNewGroup"},{"host":null,"methods":["GET","HEAD"],"uri":"maintenance\/groups\/remove\/{id}","name":"remove_assessor_group","action":"App\Http\Controllers\AssessorMaintenanceController@getRemoveGroup"},{"host":null,"methods":["POST"],"uri":"maintenance\/groups\/place\/assessor","name":"post_maintenance_assessor_groups","action":"App\Http\Controllers\AssessorMaintenanceController@postPlaceAssessor"},{"host":null,"methods":["POST"],"uri":"maintenance\/save\/data","name":"post_maintenance_data","action":"App\Http\Controllers\AssessorMaintenanceController@postMaintenanceData"},{"host":null,"methods":["POST"],"uri":"maintenance\/tick\/maintenance","name":"post_tick_maintenance","action":"App\Http\Controllers\AssessorMaintenanceController@postTickMaintenance"},{"host":null,"methods":["GET","HEAD"],"uri":"officials","name":"officials_home","action":"App\Http\Controllers\HomeController@getContructors"},{"host":null,"methods":["GET","HEAD"],"uri":"officials\/constructors","name":"constructors","action":"App\Http\Controllers\HomeController@getContructors"},{"host":null,"methods":["GET","HEAD"],"uri":"officials\/constructors\/add","name":"add_constructors","action":"App\Http\Controllers\HomeController@getAddContructors"},{"host":null,"methods":["GET","HEAD"],"uri":"officials\/detectors","name":"detectors","action":"App\Http\Controllers\HomeController@getDetectors"},{"host":null,"methods":["GET","HEAD"],"uri":"officials\/exam-committee","name":"exam-comittee","action":"App\Http\Controllers\HomeController@getExamCommittee"},{"host":null,"methods":["GET","HEAD"],"uri":"officials\/surveyors","name":"surveyors","action":"App\Http\Controllers\HomeController@getSurveyors"},{"host":null,"methods":["GET","HEAD"],"uri":"officials\/staff-exam-office","name":"staff-exam-office","action":"App\Http\Controllers\HomeController@getStaffExamOffice"},{"host":null,"methods":["GET","HEAD"],"uri":"notifications\/overview","name":"notification_overview","action":"App\Http\Controllers\HomeController@getNotifications"},{"host":null,"methods":["GET","HEAD"],"uri":"notifications\/overview\/show\/{id}","name":"notification_view","action":"App\Http\Controllers\HomeController@getNotification"},{"host":null,"methods":["GET","HEAD"],"uri":"notifications\/create","name":"notification_create","action":"App\Http\Controllers\HomeController@getCreeateNotifications"},{"host":null,"methods":["POST"],"uri":"notifications\/create\/new","name":"notification_create_new","action":"App\Http\Controllers\NotificationController@postNewNotification"},{"host":null,"methods":["POST"],"uri":"notifications\/save","name":"notification_save","action":"App\Http\Controllers\NotificationController@postSaveNotification"},{"host":null,"methods":["POST"],"uri":"notifications\/save\/{id}\/attachment","name":"notification_save_attachment","action":"App\Http\Controllers\NotificationController@postSaveAttachment"},{"host":null,"methods":["POST"],"uri":"notifications\/remove\/{id}\/attachment","name":"notification_remove_attachment","action":"App\Http\Controllers\NotificationController@postRemoveAttachment"},{"host":null,"methods":["GET","HEAD"],"uri":"notifications\/ajax\/get\/current\/receivers\/{mail_task_id}","name":"ajax_get_current_receivers","action":"App\Http\Controllers\NotificationController@ajaxGetCurrentReceivers"},{"host":null,"methods":["GET","HEAD"],"uri":"notifications\/ajax\/reset\/mail\/{mail_task_id}","name":"ajax_reset_mail","action":"App\Http\Controllers\NotificationController@ajaxResetMail"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard\/{year?}","name":"dashboard","action":"App\Http\Controllers\HomeController@getDashboard"},{"host":null,"methods":["GET","HEAD"],"uri":"history\/data\/get","name":"ajax_history_data_get","action":"App\Http\Controllers\FunctionalController@ajaxGetHistoryData"},{"host":null,"methods":["GET","HEAD"],"uri":"assessor\/data\/get","name":"ajax_assessor_data_get","action":"App\Http\Controllers\FunctionalController@ajaxGetAssessorData"},{"host":null,"methods":["GET","HEAD"],"uri":"users","name":"users","action":"App\Http\Controllers\HomeController@getUsers"},{"host":null,"methods":["GET","HEAD"],"uri":"users\/new","name":"add_users","action":"App\Http\Controllers\HomeController@getNewUsers"},{"host":null,"methods":["POST"],"uri":"users\/new","name":"new_user","action":"App\Http\Controllers\UserController@postNewAdmin"},{"host":null,"methods":["GET","HEAD"],"uri":"bookmark\/history","name":"create_bookmark","action":"App\Http\Controllers\FunctionalController@makeBookmark"},{"host":null,"methods":["GET","HEAD"],"uri":"ajax\/search\/{search_stroke?}","name":"ajax_search","action":"App\Http\Controllers\FunctionalController@ajax_search"},{"host":null,"methods":["GET","HEAD"],"uri":"ajax\/get\/colleges\/{option}","name":"ajax_get_colleges","action":"App\Http\Controllers\FunctionalController@ajaxGetColleges"},{"host":null,"methods":["GET","HEAD"],"uri":"ajax\/get\/actieve\/from\/{table}","name":"ajax_get_actieve_from_table","action":"App\Http\Controllers\FunctionalController@ajaxGetActieveFrom"},{"host":null,"methods":["GET","HEAD"],"uri":"ajax\/check\/user\/password\/{password}","name":"ajax_check_user_password","action":"App\Http\Controllers\FunctionalController@ajaxCheckPassword"},{"host":null,"methods":["GET","HEAD"],"uri":"ajax\/get\/assessor\/{idw}","name":"ajax_get_assessor_info","action":"App\Http\Controllers\FunctionalController@ajaxGetAssessor"},{"host":null,"methods":["GET","HEAD"],"uri":"ajax\/get\/partial\/{name}","name":"ajax_get_partial_view","action":"App\Http\Controllers\FunctionalController@ajaxGetPartial"},{"host":null,"methods":["POST"],"uri":"ajax\/resend\/emails","name":"ajax_post_resend_mails","action":"App\Http\Controllers\FunctionalController@ajaxResendMails"},{"host":null,"methods":["GET","HEAD"],"uri":"idle\/{url?}","name":"idle","action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"lockscreen","name":"lockscreen","action":"App\Http\Controllers\UserController@getLockScreen"},{"host":null,"methods":["POST"],"uri":"lockscreen\/unlock","name":"unlock","action":"App\Http\Controllers\UserController@postUnlockScreen"},{"host":null,"methods":["GET","HEAD"],"uri":"logout","name":"logout","action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"cronjobs","name":"cronjob","action":"App\Http\Controllers\FunctionalController@CronJobs"},{"host":null,"methods":["GET","HEAD"],"uri":"login","name":"login","action":"App\Http\Controllers\Auth\LoginController@showLoginForm"},{"host":null,"methods":["POST"],"uri":"login","name":null,"action":"App\Http\Controllers\Auth\LoginController@login"},{"host":null,"methods":["POST"],"uri":"logout","name":"logout","action":"App\Http\Controllers\Auth\LoginController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"register","name":"register","action":"App\Http\Controllers\Auth\RegisterController@showRegistrationForm"},{"host":null,"methods":["POST"],"uri":"register","name":null,"action":"App\Http\Controllers\Auth\RegisterController@register"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset","name":null,"action":"App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm"},{"host":null,"methods":["POST"],"uri":"password\/email","name":null,"action":"App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset\/{token}","name":null,"action":"App\Http\Controllers\Auth\ResetPasswordController@showResetForm"},{"host":null,"methods":["POST"],"uri":"password\/reset","name":null,"action":"App\Http\Controllers\Auth\ResetPasswordController@reset"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                if (this.absolute && this.isOtherHost(route)){
                    return "//" + route.host + "/" + uri + qs;
                }

                return this.getCorrectUrl(uri + qs);
            },

            isOtherHost: function (route){
                return route.host && route.host != window.location.hostname;
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if ( ! this.absolute) {
                    return url;
                }

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

