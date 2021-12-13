/* eslint-disable no-script-url */

import queryString from 'query-string';
import { CriteriaFilterValues } from './Filter/ContentFilter';
import { KeyValList } from 'lib/services/api/ParsedApiSpecInterface';
import { SearchFilterType } from './Filter/icons/FilterIconFactory';

export const criteriaFilterValuesToString = (where: CriteriaFilterValues): string => {

    if (!where.length) {
        return '';
    }

    const searchArguments: Array<string> = [];
    for (const criteria of where) {

        const {name, type, value} = criteria;
        if (type === 'exists') {
            searchArguments.push(
                `exists[${name}]=true`
            );
        } else if (type === 'in') {
            searchArguments.push(
                `${name}[]=${value}`
            );
        } else {
            searchArguments.push(
                `${name}[${type}]=${value}`
            );
        }
    }

    return '?' + searchArguments.join('&');
}

export const queryStringToCriteria = (): CriteriaFilterValues => {

    const criteria: CriteriaFilterValues = [];
    const querystring: KeyValList = queryString.parse(location.search || '');

    for (const idx in querystring) {
        const value = querystring[idx] as string|number|boolean|Array<any>;
        const matches = idx.match(/([^[]+)\[?([^\]]*)\]?/);

        if (!matches) {
            continue;
        }

        if (Array.isArray(value)) {
            for (const val of value) {
                criteria.push({
                    name: matches[1],
                    type: 'in',
                    value: val
                });
            }

            continue;
        }

        if (matches[1] === 'exists') {
            criteria.push({
                name: matches[2],
                type: 'exists',
                value: ''
            });

            continue;
        }

        criteria.push({
            name: matches[1],
            type: matches[2] as SearchFilterType,
            value
        });
    }

    return criteria;
}

