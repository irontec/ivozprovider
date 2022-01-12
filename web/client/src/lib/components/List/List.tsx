/* eslint-disable no-script-url */

import { useState, useEffect } from 'react';
import { useStoreActions, useStoreState } from 'store';
import { withRouter, RouteComponentProps } from "react-router-dom";
import EntityService from 'lib/services/entity/EntityService';
import { CriteriaFilterValues } from './Filter/ContentFilter';
import { criteriaToArray, queryStringToCriteria } from './List.helpers';
import ContentTable from './ContentTable/ContentTable';
import ContentTablePagination from './ContentTable/ContentTablePagination';
import useQueryStringParams from './useQueryStringParams';
import axios from 'axios';

const List = function (props: any & RouteComponentProps) {

    const { path, history, foreignKeyResolver } = props;
    const { entityService }: { entityService: EntityService } = props;

    const [rows, setRows] = useState<Array<any>>([]);
    const [headers, setHeaders] = useState<{ [id: string]: string }>({});

    const apiGet = useStoreActions((actions: any) => {
        return actions.api.get
    });
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

            const newReqQuerystring = criteriaToArray(queryStringCriteria).join('&')

            if (reqQuerystring === newReqQuerystring) {
                return;
            }

            history.push({
                pathname: path,
                search: newReqQuerystring
            });
        },
        [
            reqQuerystring, prevReqQuerystring, path, queryStringCriteria,
            history
        ]
    );

    useEffect(
        () => {

            let mounted = true;
            const CancelToken = axios.CancelToken;
            const source = CancelToken.source();

            // Fetch data request
            if (!criteriaIsReady) {
                return;
            }

            const reqPath = currentQueryParams.length
                ? path + '?' + encodeURI(currentQueryParams.join('&'))
                : path;

            apiGet({
                path: reqPath,
                successCallback: async (data: any, headers: any) => {

                    if (!mounted) {
                        return;
                    }

                    if (headers) {
                        setHeaders(headers);
                    }

                    setRows(data);

                    foreignKeyResolver(data, entityService)
                        .then((data: any) => {

                            const fixedData = [];
                            for (const idx in data) {
                                fixedData.push(
                                    data[idx],
                                );
                            }

                            setRows(fixedData);
                        });
                },
                cancelToken: source.token
            });

            return () => {
                mounted = false;
                source.cancel();
            }
        },
        [
            foreignKeyResolver, entityService, criteriaIsReady,
            path, currentQueryParams, apiGet, reqQuerystring
        ]
    );

    // @TODO move into store/api
    const recordCount = parseInt(
        headers['x-total-items'] ?? 0,
        10
    );

    return (
        <>
            <ContentTable
                path={path}
                rows={rows}
                preloadData={currentQueryParams.length > 0}
                entityService={entityService}
            />
            <ContentTablePagination
                recordCount={recordCount}
            />
        </>

    );
}

export default withRouter(List);

