/* eslint-disable no-script-url */

import { useState, useEffect } from 'react';
import { CriteriaFilterValue, CriteriaFilterValues } from '../shared/ContentFilter';


interface useRequestPathProps {
    where: CriteriaFilterValues,
    basePath: string
}

function useFilterRequestPath(props: useRequestPathProps) {

    const {
        where, basePath
    } = props;
    const [reqPath, setReqPath] = useState<string>(basePath);
    const [mounted, setMounted] = useState<boolean>(true);

    useEffect(
        () => {

            const containsCriteria = Object.keys(where).length > 0;

            if (mounted && containsCriteria) {

                const criteria: Array<string> = [];
                for (const name in where) {

                    if (!where[name] || !where[name]?.type) {
                        continue;
                    }

                    const currentCondition = where[name] as CriteriaFilterValue;
                    const type = ['eq', 'exact'].includes(currentCondition.type)
                        ? ''
                        : currentCondition.type;
                    const value = currentCondition.value;

                    criteria.push(
                        encodeURIComponent(`${name}[${type}]`)
                        + '='
                        + encodeURIComponent(value)
                    );
                }

                setReqPath(basePath + '?' + criteria.join('&'));
            }

            return function umount() {
                setMounted(false);
            };
        },
        [
            where, basePath,
        ]
    );

    return reqPath;
}

export default useFilterRequestPath;