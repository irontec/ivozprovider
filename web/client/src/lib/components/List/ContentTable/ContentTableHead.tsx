import {
    TableCell, TableHead, TableRow, TableSortLabel
} from '@mui/material';
import { isPropertyFk } from 'lib/services/api/ParsedApiSpecInterface';
import EntityService from 'lib/services/entity/EntityService';
import { useStoreActions, useStoreState } from 'store';
import { ROUTE_ORDER_KEY } from 'store/route';
import { CriteriaFilterValue } from '../Filter/ContentFilter';
import { StyledTableSortLabelVisuallyHidden } from './ContentTableHead.styles';

interface ContentTableHead {
    entityService: EntityService
}

const ContentTableHead = function (props: ContentTableHead): JSX.Element {

    const {
        entityService
    } = props;

    const columns = entityService.getCollectionColumns();

    const order = useStoreState(
        (state) => state.route.order
    );
    const direction = order?.direction || false;
    const replaceInQueryStringCriteria = useStoreActions((actions) => {
        return actions.route.replaceInQueryStringCriteria;
    });

    const setSort = (property: string, direction: 'asc' | 'desc') => {
        const order: CriteriaFilterValue = {
            name: ROUTE_ORDER_KEY,
            type: property,
            value: direction,
        }

        replaceInQueryStringCriteria(order);
    }

    const createSortHandler = (property: string) => () => {
        const isDesc = order?.name === property && direction === 'desc';
        setSort(
            property,
            isDesc ? 'asc' : 'desc'
        );
    };

    return (
        <TableHead>
            <TableRow>
                {Object.keys(columns).map((key: string) => (
                    <TableCell
                        key={key}
                        align='left'
                        padding='normal'
                        sortDirection={order?.name === key ? direction : false}
                    >
                        {!isPropertyFk(columns[key]) && <TableSortLabel
                            active={order?.name === key}
                            direction={order?.direction}
                            onClick={createSortHandler(key)}
                        >
                            {columns[key].label}
                            {order?.name === key ? (
                                <StyledTableSortLabelVisuallyHidden>
                                    {order?.direction === 'desc' ? 'sorted descending' : 'sorted ascending'}
                                </StyledTableSortLabelVisuallyHidden>
                            ) : null}
                        </TableSortLabel>}
                        {isPropertyFk(columns[key]) && <>
                            {columns[key].label}
                            {order?.name === key ? (
                                <StyledTableSortLabelVisuallyHidden>
                                    {order?.direction === 'desc' ? 'sorted descending' : 'sorted ascending'}
                                </StyledTableSortLabelVisuallyHidden>
                            ) : null}
                        </>}
                    </TableCell>
                ))}
                <TableCell
                    key={'empty slot'}
                    align='left'
                    padding='normal'
                ></TableCell>
            </TableRow>
        </TableHead>
    );
}

export default ContentTableHead;