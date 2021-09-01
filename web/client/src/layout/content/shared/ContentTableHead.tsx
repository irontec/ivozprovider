import {
    TableCell, TableHead, TableRow, TableSortLabel
} from '@material-ui/core';

const ContentTableHead = function (props: any) {
    const {
        entityService,
        classes,
        order,
        orderBy,
        onRequestSort
    } = props;

    const columns = entityService.getCollectionColumns();

    const createSortHandler = (property: string) => (event: any) => {
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
                        padding='default'
                        sortDirection={orderBy === key ? order : false}
                    >
                        <TableSortLabel
                            active={orderBy === key}
                            direction={order}
                            onClick={createSortHandler(key)}
                        >
                            {columns[key].label}
                            {orderBy === key ? (
                                <span className={classes.visuallyHidden}>
                                    {order === 'desc' ? 'sorted descending' : 'sorted ascending'}
                                </span>
                            ) : null}
                        </TableSortLabel>
                    </TableCell>
                ))}
                <TableCell
                    key={'empty slot'}
                    align='left'
                    padding='default'
                ></TableCell>
            </TableRow>
        </TableHead>
    );
}

export default ContentTableHead;