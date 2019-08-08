import _ from 'lodash'

export function toQueryString(params) {
    return _.map(params, (val, key) => {
        return key + '=' + val
    }).join('&')
}

export function timeFormatter(time, formatter) {
    let d = new Date(time * 1000)
    return formatter.replace('Y', d.getFullYear())
            .replace('m', _.padStart(d.getMonth() + 1, 2, 0))
            .replace('d', _.padStart(d.getDate(), 2, 0))
            .replace('H', _.padStart(d.getHours(), 2, 0))
            .replace('i', _.padStart(d.getMinutes(), 2, 0))
            .replace('s', _.padStart(d.getSeconds(), 2, 0))
}