/* eslint-disable no-script-url */

import { useState, useEffect, useMemo } from 'react';
import { useStoreActions } from 'easy-peasy';
//import queryString from 'query-string';
import { withRouter, RouteComponentProps } from "react-router-dom";
import ContentTable from './ContentTable/ContentTable';
import EntityService from 'lib/services/entity/EntityService';
import useFilterRequestPath from './useFilterRequestPath';
import { CriteriaFilterValues } from './Filter/ContentFilter';

const List = function (props: any & RouteComponentProps) {

    const { path, history, location, foreignKeyResolver } = props;
    const { entityService }: { entityService: EntityService } = props;

    const [mounted, setMounted] = useState<boolean>(true);
    const [loading, setLoading] = useState(true);
    const [rows, setRows] = useState<Array<any>>([]);
    const [headers, setHeaders] = useState<{ [id: string]: string }>({});
    const [page, setPage] = useState<number>(1);
    const [rowsPerPage, setRowsPerPage] = useState<number>(10);

    const apiGet = useStoreActions((actions: any) => {
        return actions.api.get
    });

    //const querystring = queryString.parse(location.search || '');
    const criteria: CriteriaFilterValues = []; /* TODO querystring._criteria
        ? JSON.parse(querystring._criteria as string)
        : {};*/

    const [where, setWhere] = useState<CriteriaFilterValues>(criteria);
    const [orderBy, setOrderBy] = useState(entityService.getOrderBy());
    const [orderDirection, setOrderDirection] = useState(entityService.getOrderDirection());

    const setSort = (property: string, direction: 'asc' | 'desc') => {
        setOrderBy(property);
        setOrderDirection(direction);
        setLoading(true);
    }

    const applyFilters = (where: any) => {

        const search = Object.keys(where).length
            ? '?_criteria=' + JSON.stringify(where)
            : '';

        history.push({
            pathname: location.pathname,
            search
        });
        setWhere(where);
        setLoading(true);
    }

    const reqPath = useFilterRequestPath({
        where,
        basePath: path,
    });

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

    useEffect(
        () => {
            if (mounted && loading) {

                apiGet({
                    path: reqPath,
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
                                setLoading(false);
                            });
                    }
                });
            }

            return function umount() {
                setMounted(false);
            };
        },
        [
            mounted, loading, foreignKeyResolver, entityService,
            apiGet, reqPath, paginationParams
        ]
    );

    return (
        <ContentTable
            entityService={entityService}
            loading={loading}
            rows={rows}
            headers={headers}
            page={page}
            rowsPerPage={rowsPerPage}
            setRowsPerPage={setRowsPerPage}
            setPage={setPage}
            orderBy={orderBy}
            orderDirection={orderDirection}
            setSort={setSort}
            setLoading={setLoading}
            where={where}
            setWhere={applyFilters}
            path={path}
        />
    );
}

export default withRouter(List);