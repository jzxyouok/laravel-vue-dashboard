import Vue from 'vue';
import moment from 'moment';
import { formatNumber, gridFromTo, modifyClass, relativeDate, fileDate, displayDateTime, displayDate, displayTime } from './helpers';

Vue.filter('relative-date', relativeDate);

Vue.filter('file-date', fileDate);

Vue.filter('display-date-time', displayDateTime);

Vue.filter('display-date', displayDate);

Vue.filter('display-time', displayTime);

Vue.filter('format-number', formatNumber);

Vue.filter('grid-from-to', gridFromTo);

Vue.filter('modify-class', modifyClass);

Vue.filter('sumTransactions', function (list, key1) {
    return list.reduce(function(total, item) {
        return total + item[key1]
    }, 0)
})

Vue.filter('sumPayments', function (list, key1) {
    return list.reduce(function(total, item) {
        return parseFloat(total) + parseFloat(item[key1])
    }, 0)
})

Vue.filter('eventDuration', function (list, key1, key2) {
	if (typeof list !== 'undefined') {
		let startDate = moment(list[key1]);
		let endDate = moment(list[key2]);
		let timeDiff = endDate.diff(startDate, 'hours');

	    return 'for ' + moment.duration(timeDiff, 'hours').humanize();
	}
})

Vue.filter('eventTime', function (list, key1, key2, key3) {
	if (typeof list !== 'undefined') {
		let startDate = moment(list[key1]);
		let endDate = moment(list[key2]);
		let allDay = list[key3];

		if (allDay) {
			return 'All Day';
		} else {
			return startDate.format('h:mm a') + ' - ' + endDate.format('h:mm a')
		}
	}
})