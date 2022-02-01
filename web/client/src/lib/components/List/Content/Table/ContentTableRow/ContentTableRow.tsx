/* eslint-disable no-script-url */

import React from 'react';
import { TableRow } from '@mui/material';
import EntityService from 'lib/services/entity/EntityService';
import {
  StyledActionsTableCell, StyledTableCell
} from './ContentTableRow.styles';
import DeleteRowButton from '../../CTA/DeleteRowButton';
import ListContentValue from '../../ListContentValue';
import EditRowButton from '../../CTA/EditRowButton';
import ViewRowButton from '../../CTA/ViewRowButton';

interface ContentTableRowProps {
  entityService: EntityService,
  row: any,
  path: string
}

export default function ContentTableRow(props: ContentTableRowProps): JSX.Element {

  const { entityService, row, path } = props;

  const columns = entityService.getCollectionColumns();
  const acl = entityService.getAcls();
  const RowActions: React.FunctionComponent | any = entityService.getRowActions();

  return (
    <TableRow hover key={row.id}>
      {Object.keys(columns).map((key: string) => {
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
        {!acl.update && <ViewRowButton row={row} path={path} />}
        &nbsp;
        {acl.delete && <DeleteRowButton row={row} entityService={entityService} />}
        {<RowActions row={row} />}
      </StyledActionsTableCell>
    </TableRow>
  );
}
