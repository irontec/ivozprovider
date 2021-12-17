/* eslint-disable no-script-url */

import { useState, useEffect, useMemo } from 'react';
import { useStoreActions, useStoreState } from 'store';
import { withRouter, RouteComponentProps } from "react-router-dom";
import ContentTable from './ContentTable/ContentTable';
import EntityService from 'lib/services/entity/EntityService';
import { CriteriaFilterValues } from './Filter/ContentFilter';
import { criteriaFilterValuesToString, queryStringToCriteria } from './List.helpers';

const List = function (props: any & RouteComponentProps) {

    const { path, history, foreignKeyResolver } = props;
    const { entityService }: { entityService: EntityService } = props;

    const [rows, setRows] = useState<Array<any>>([]);
    const [headers, setHeaders] = useState<{ [id: string]: string }>({});

    const [page, setPage] = useState<number>(1);
    const [rowsPerPage, setRowsPerPage] = useState<number>(10);

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

    const uriCriteria: CriteriaFilterValues = queryStringToCriteria();
    const currentQueryString = criteriaFilterValuesToString(uriCriteria);
    const reqPath = path + currentQueryString;

    ////////////////////////////
    // Pagination
    ////////////////////////////
    const [orderBy, setOrderBy] = useState(entityService.getOrderBy());
    const [orderDirection, setOrderDirection] = useState(entityService.getOrderDirection());

    const setSort = (property: string, direction: 'asc' | 'desc') => {
        setOrderBy(property);
        setOrderDirection(direction);
    }

    const paginationParams = useMemo(
        () => {
            const paginationParams: any = {
                _itemsPerPage: rowsPerPage,
                _page: page
            };

            const orderByFld = `_order[${orderBy}]`;
            paginationParams[orderByFld] = orderDirection;

            return paginationParams;
        },
        [rowsPerPage, page, orderBy, orderDirection]
    );

    ////////////////////////////
    // End of pagination
    ////////////////////////////

    useEffect(
        () => {
            const criteria = queryStringToCriteria();
            setQueryStringCriteria(criteria);
            setCriteriaIsReady(true);
        },
        [reqPath, setQueryStringCriteria, setCriteriaIsReady]
    );

    useEffect(
        () => {

            if (!criteriaIsReady) {
                return;
            }

            const newQueryString = criteriaFilterValuesToString(queryStringCriteria);
            if (currentQueryString === newQueryString) {
                return;
            }

            history.push({
                pathname: path,
                search: newQueryString
            });
        },
        [criteriaIsReady, queryStringCriteria, currentQueryString, history, path]
    );

    useEffect(
        () => {
            apiGet({
                path: encodeURI(reqPath),
                params: paginationParams,
                successCallback: async (data: any, headers: any) => {

                    if (headers) {
                        setHeaders(headers);
                    }

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
                }
            });
        },
        [
            foreignKeyResolver, entityService,
            apiGet, reqPath, paginationParams
        ]
    );

    return (
        <ContentTable
            entityService={entityService}
            rows={rows}
            headers={headers}
            page={page}
            rowsPerPage={rowsPerPage}
            setRowsPerPage={setRowsPerPage}
            setPage={setPage}
            orderBy={orderBy}
            orderDirection={orderDirection}
            setSort={setSort}
            uriCriteria={uriCriteria}
            path={path}
        />
    );
}

export default withRouter(List);

