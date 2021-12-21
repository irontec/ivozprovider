/* eslint-disable no-script-url */

import { useState, useEffect } from 'react';
import { CriteriaFilterValues } from './Filter/ContentFilter';
import { criteriaToArray, stringToCriteria } from './List.helpers';

const useQueryStringParams = function (): Array<string> {

    const [currentQueryParams, setCurrentQueryParams] = useState<Array<string>>([]);
    const uri = location.search;

    useEffect(
        () => {
            const uriCriteria: CriteriaFilterValues = stringToCriteria(uri);
            setCurrentQueryParams(
                criteriaToArray(uriCriteria)
            );
        },
        [uri]
    );

    return currentQueryParams;
}

export default useQueryStringParams;

