/* eslint-disable no-script-url */

import { useState, useEffect } from 'react';
import { useStoreActions, useStoreState } from 'store';
import { withRouter, RouteComponentProps } from "react-router-dom";
import { WithRouterProps, WithRouterStatics } from "react-router";
import EntityService from 'lib/services/entity/EntityService';
import { CriteriaFilterValues } from './Filter/ContentFilter';
import { criteriaToArray, queryStringToCriteria } from './List.helpers';
import ListContent from './Content/ListContent';
import Pagination from './Pagination';
import useQueryStringParams from './useQueryStringParams';
import useCancelToken from 'lib/hooks/useCancelToken';
import { RouteMap } from 'lib/router/routeMapParser';
import { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import findRoute from 'lib/router/findRoute';

type RouterProps = RouteComponentProps & WithRouterProps<any> & WithRouterStatics<any>;
type ListProps = RouterProps & {
    path: string,
    routeMap: RouteMap,
    entityService: EntityService,
    foreignKeyResolver: foreignKeyResolverType
}

const List = function (props: ListProps) {

    const {
        path, history, foreignKeyResolver, entityService, routeMap, match, location
    } = props;

    const currentRoute = findRoute(routeMap, match);
    const [rows, setRows] = useState<Array<any>>([]);
    const [headers, setHeaders] = useState<{ [id: string]: string }>({});

    const apiGet = useStoreActions((actions: any) => {
        return actions.api.get
    });
    const [mounted, cancelToken] = useCancelToken();

    const [criteriaIsReady, setCriteriaIsReady] = useState<boolean>(false);
    const queryStringCriteria: CriteriaFilterValues = useStoreState(
        (state) => state.route.queryStringCriteria
    );
    const setQueryStringCriteria = useStoreActions((actions) => {
        return actions.route.setQueryStringCriteria;
    });

    ////////////////////////////
    // Filters
    ////////////////////////////
    const currentQueryParams = useQueryStringParams();
    const filterBy: Array<string> = [];
    if (currentRoute?.filterBy) {
        filterBy.push(
            currentRoute.filterBy
        );
        filterBy.push(
            Object.values(match.params).pop() as string
        );
    }
    const filterByStr = filterBy.join('[]=');
    const reqQuerystring = currentQueryParams.join('&');
    const [prevReqQuerystring, setPrevReqQuerystring] = useState<string | null>(null);

    useEffect(
        () => {

            // Path change listener
            if (reqQuerystring === prevReqQuerystring) {
                return;
            }

            setPrevReqQuerystring(reqQuerystring);
            const criteria = queryStringToCriteria();
            setQueryStringCriteria(criteria);
            setCriteriaIsReady(true);
        },
        [
            reqQuerystring, prevReqQuerystring, setPrevReqQuerystring,
            setQueryStringCriteria, criteriaIsReady, setCriteriaIsReady
        ]
    );

    useEffect(
        () => {

            // Criteria change listener
            if (reqQuerystring !== prevReqQuerystring) {
                return;
            }

            const newReqQuerystring = criteriaToArray(queryStringCriteria).join('&');

            if (reqQuerystring === newReqQuerystring) {
                return;
            }

            history.push({
                pathname: location.pathname,
                search: newReqQuerystring
            });
        },
        [
            reqQuerystring, prevReqQuerystring, location.pathname, queryStringCriteria,
            history
        ]
    );

    useEffect(
        () => {

            if (!mounted) {
                return;
            }

            // Fetch data request
            if (!criteriaIsReady) {
                return;
            }

            let reqPath = currentQueryParams.length
                ? path + '?' + encodeURI([...currentQueryParams, filterByStr].join('&'))
                : path;

            let orderBy = currentQueryParams.find(
                (str: string) => str.indexOf('_order[') === 0
            );
            if (!orderBy) {
                orderBy = encodeURI(
                    `_order[${entityService.getOrderBy()}]=${entityService.getOrderDirection()}`
                );
                const glue = currentQueryParams.length > 0
                    ? '&'
                    : '?';

                reqPath += `${glue}${orderBy}`;
            }

            apiGet({
                path: reqPath,
                cancelToken,
                successCallback: async (data: any, headers: any) => {

                    if (!mounted) {
                        return;
                    }

                    if (headers) {
                        setHeaders(headers);
                    }

                    setRows(data);
                    foreignKeyResolver({ data, allowLinks: true, entityService, cancelToken })
                        .then((data: any) => {

                            if (!mounted) {
                                return;
                            }

                            const fixedData = [];
                            for (const idx in data) {
                                fixedData.push(
                                    data[idx],
                                );
                            }

                            setRows(fixedData);
                        });
                }
            });
        },
        [
            foreignKeyResolver, entityService, criteriaIsReady,
            path, currentQueryParams, apiGet, reqQuerystring,
            filterByStr, cancelToken, mounted
        ]
    );

    // @TODO move into store/api
    const recordCount = parseInt(
        headers['x-total-items'] ?? 0,
        10
    );

    return (
        <>
            <ListContent
                childEntities={currentRoute?.children || []}
                path={path}
                rows={rows}
                ignoreColumn={filterBy[0]}
                preloadData={currentQueryParams.length > 0}
                entityService={entityService}
            />
            <Pagination
                recordCount={recordCount}
            />
        </>

    );
}

export default withRouter(List);