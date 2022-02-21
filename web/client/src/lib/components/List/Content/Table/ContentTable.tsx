import { Table, TableBody, TableRow } from '@mui/material';
import ContentTableHead from './ContentTableHead';
import EntityService from 'lib/services/entity/EntityService';
import { StyledActionsTableCell, StyledTableCell } from './ContentTable.styles';
import ListContentValue from '../ListContentValue';
import EditRowButton from '../CTA/EditRowButton';
import ViewRowButton from '../CTA/ViewRowButton';
import DeleteRowButton from '../CTA/DeleteRowButton';
import { RouteMapItem } from 'lib/router/routeMapParser';
import ChildEntityLinks from '../Shared/ChildEntityLinks';

interface ContentTableProps {
  childEntities: Array<RouteMapItem>,
  entityService: EntityService,
  rows: Record<string, any>,
  ignoreColumn: string | undefined,
  path: string,
}

const ContentTable = (props: ContentTableProps): JSX.Element => {

  const { childEntities, entityService, rows, path, ignoreColumn } = props;

  return (
    <Table size="medium" sx={{ "tableLayout": 'fixed' }}>
      <ContentTableHead
        entityService={entityService}
        ignoreColumn={ignoreColumn}
      />
      <TableBody>
        {rows.map((row: any, key: any) => {

          const columns = entityService.getCollectionColumns();
          const acl = entityService.getAcls();

          return (
            <TableRow hover key={key}>
              {Object.keys(columns).map((key: string) => {

                if (key === ignoreColumn) {
                  return null;
                }

                const column = columns[key];

                return (
                  <StyledTableCell key={key}>
                    <ListContentValue
                      columnName={key}
                      column={column}
                      row={row}
                      entityService={entityService}
                    />
                  </StyledTableCell>
                );
              })}
              <StyledActionsTableCell key="actions">
                {acl.update && <EditRowButton row={row} path={path} />}
                {acl.detail && !acl.update && <ViewRowButton row={row} path={path} />}
                {acl.delete && <DeleteRowButton row={row} entityService={entityService} />}
                &nbsp;
                <ChildEntityLinks childEntities={childEntities} row={row} />
              </StyledActionsTableCell>
            </TableRow>
          );
        })}
      </TableBody>
    </Table>
  );
}

export default ContentTable;