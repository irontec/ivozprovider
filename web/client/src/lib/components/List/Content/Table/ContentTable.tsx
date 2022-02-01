import { Table, TableBody } from '@mui/material';
import ContentTableHead from './ContentTableHead';
import ContentTableRow from './ContentTableRow';
import EntityService from 'lib/services/entity/EntityService';

interface ContentTableProps {
  entityService: EntityService,
  rows: Record<string, any>,
  path: string,
}

const ContentTable = (props:ContentTableProps): JSX.Element => {

  const { entityService, rows, path } = props;

  return (
    <Table size="medium" sx={{"tableLayout": 'fixed'}}>
      <ContentTableHead
        entityService={entityService}
      />
      <TableBody>
      {rows.map((row: any, key: any) => {
        return (
          <ContentTableRow
            key={key}
            entityService={entityService}
            row={row}
            path={path}
          />
        );
      })}
      </TableBody>
    </Table>
  );
}

export default ContentTable;