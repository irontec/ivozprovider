/* eslint-disable no-script-url */

import { useState, useEffect } from 'react';
import { useStoreActions } from 'easy-peasy';
import queryString from 'query-string';
import { withRouter } from "react-router-dom";
import ContentTable from './shared/ContentTable';
import EntityService from 'services/Entity/EntityService';

const List = function (props: any) {
    const { path, history, location, foreignKeyResolver, unmarshaller } = props;
    const { entityService }: {entityService: EntityService } = props;

    const [loading, setLoading] = useState(true);
    const [rows, setRows] = useState<Array<any>>([]);
    const [headers, setHeaders] = useState<{ [id: string]: string }>({});
    const [page, setPage] = useState<number>(1);
    const [rowsPerPage, setRowsPerPage] = useState<number>(10);

    const apiGet = useStoreActions((actions:any) => {
        return actions.api.get
    });

    const querystring = queryString.parse(location.search || '');
    const criteria = querystring._criteria
        ? JSON.parse(querystring._criteria as string)
        : {};

    const [where, setWhere] = useState<any>(criteria);
    const [orderBy, setOrderBy] = useState(entityService.getOrderBy());
    const [orderDirection, setOrderDirection] = useState(entityService.getOrderDirection());

    const setSort = (property: string, direction: string) => {
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

    useEffect(
        () => {
            if (loading) {

                const params: any = {
                    _itemsPerPage: rowsPerPage,
                    _page: page
                };

                const orderByFld = `_order[${orderBy}]`;
                params[orderByFld] = orderDirection;

                const containsCriteria = Object.keys(where).length > 0;
                let reqPath = path;

                if (containsCriteria) {

                    let criteria: Array<string> = [];
                    for (const name in where) {
                        const type = ['eq', 'exact'].includes(where[name].type)
                            ? ''
                            : where[name].type;
                        const value = where[name].value;

                        criteria.push(
                            encodeURIComponent(`${name}[${type}]`)
                            + '='
                            + encodeURIComponent(value)
                        );
                    }

                    reqPath = path + '?' + criteria.join('&');
                }

                apiGet({
                    path: reqPath,
                    params,
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

            return function umount() {};
        },
        [
            loading, foreignKeyResolver, entityService, where,
            orderBy, orderDirection, page, rowsPerPage, apiGet,
            path, unmarshaller
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