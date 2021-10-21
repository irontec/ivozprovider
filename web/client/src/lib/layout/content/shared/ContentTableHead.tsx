import {
    TableCell, TableHead, TableRow, TableSortLabel
} from '@mui/material';
import EntityService from 'lib/services/entity/EntityService';
import { StyledTableSortLabelVisuallyHidden } from './ContentTableHead.styles';

interface ContentTableHead {
    entityService: EntityService,
    order: 'asc' | 'desc',
    orderBy: string,
    onRequestSort: (property: string, order: 'asc' | 'desc') => void
}

const ContentTableHead = function (props: ContentTableHead): JSX.Element {

    const {
        entityService,
        order,
        orderBy,
        onRequestSort
    } = props;

    const columns = entityService.getCollectionColumns();

    const createSortHandler = (property: string) => () => {
        const isDesc = orderBy === property && order === 'desc';
        onRequestSort(
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
                        sortDirection={orderBy === key ? order : false}
                    >
                        <TableSortLabel
                            active={orderBy === key}
                            direction={order}
                            onClick={createSortHandler(key)}
                        >
                            {columns[key].label}
                            {orderBy === key ? (
                                <StyledTableSortLabelVisuallyHidden>
                                    {order === 'desc' ? 'sorted descending' : 'sorted ascending'}
                                </StyledTableSortLabelVisuallyHidden>
                            ) : null}
                        </TableSortLabel>
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