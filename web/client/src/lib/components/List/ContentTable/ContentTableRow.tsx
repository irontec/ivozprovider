/* eslint-disable no-script-url */

import React, { useState } from 'react';
import { useHistory, useLocation } from 'react-router'
import {
  Fade,
  LinearProgress,
  TableRow, Tooltip
} from '@mui/material';
import EditIcon from '@mui/icons-material/Edit';
import PanoramaIcon from '@mui/icons-material/Panorama';
import ConfirmDialog from 'lib/components/shared/ConfirmDialog';
import EntityService from 'lib/services/entity/EntityService';
import { useStoreActions } from 'store';
import { FkProperty, ScalarProperty } from 'lib/services/api/ParsedApiSpecInterface';
import _ from 'lib/services/translations/translate';
import {
  StyledTableRowLink, StyledTableRowFkLink, StyledDeleteIcon, StyledActionsTableCell, StyledCheckBoxIcon, StyledCheckBoxOutlineBlankIcon, StyledTableCell
} from './ContentTableRow.styles';

interface ContentTableRowProps {
  entityService: EntityService,
  row: any,
  path: string
}

export default function ContentTableRow(props: ContentTableRowProps): JSX.Element {

  const { entityService, row, path } = props;

  const columns = entityService.getCollectionColumns();
  const acl = entityService.getAcls();
  const ListDecorator = entityService.getListDecorator();
  const RowActions: React.FunctionComponent | any = entityService.getRowActions();

  const [showDelete, setShowDelete] = useState<boolean>(false);
  const history = useHistory();
  const location = useLocation();

  const apiDelete = useStoreActions((actions: any) => {
    return actions.api.delete
  });

  const handleHideDelete = (): void => {
    setShowDelete(false);
  };

  const handleDelete = async (event: any): Promise<void> => {

    const path = entityService.getDeletePath();
    if (!path) {
      throw new Error('Unknown delete path');
    }

    event.preventDefault();
    try {
      const resp = await apiDelete({
        path: path.replace('{id}', row.id)
      });

      if (resp !== undefined) {
        history.replace(`${location.pathname}/__reloading`);
        setTimeout(() => {
          history.replace(location.pathname);
        });
      }
    } catch (error: unknown) {
      setShowDelete(false);
    }
  };

  return (
    <TableRow hover key={row.id}>
      {Object.keys(columns).map((key: string) => {
        const column = columns[key];
        const customComponent = (column as ScalarProperty).component;

        const loadingValue =
          ((column as FkProperty).$ref && row[key] && !row[`${key}Id`] && (column as FkProperty).type !== 'file')
          || (column as ScalarProperty).type === 'array' && Array.isArray(row[key]);

        const enumValues: any = (column as ScalarProperty).enum;
        const value = row[key];
        const isBoolean = typeof value === "boolean";

        let response = value;
        if (loadingValue || (row[key] === undefined && !customComponent)) {

          response = (
            <Fade
              in={true}
              style={{
                transitionDelay: '1000ms',
              }}
              unmountOnExit
            >
              <LinearProgress color="inherit" />
            </Fade>
          );
        } else if (isBoolean && !enumValues && value) {
          response = <StyledCheckBoxIcon />;
        } else if (isBoolean && !enumValues) {
          response = <StyledCheckBoxOutlineBlankIcon />;
        } else if (row[`${key}Link`]) {
          response =
            <StyledTableRowFkLink to={row[`${key}Link`]}>
              {value}
            </StyledTableRowFkLink>
        } else {
          response = <ListDecorator field={key} row={row} property={column} />
        }

        const prefix = column?.prefix || '';

        return <StyledTableCell key={key}>{prefix}{response}</StyledTableCell>;
      })}
      <StyledActionsTableCell key="actions">
        {acl.update && <Tooltip title={_('Edit')} placement="bottom">
          <StyledTableRowLink to={`${path}/${row.id}/update`}>
            <EditIcon />
          </StyledTableRowLink>
        </Tooltip>}
        {!acl.update && <Tooltip title={_('View')} placement="bottom">
          <StyledTableRowLink to={`${path}/${row.id}/detailed`}>
            <PanoramaIcon />
          </StyledTableRowLink>
        </Tooltip>}
        &nbsp;
        {acl.delete && <Tooltip title={_('Delete')} placement="bottom">
          <StyledDeleteIcon onClick={() => setShowDelete(true)} />
        </Tooltip>}
        {acl.delete && <ConfirmDialog
          text={`You're about to remove item #${row.id}`}
          open={showDelete}
          handleClose={handleHideDelete}
          handleApply={handleDelete}
        />}
        {<RowActions row={row} />}
      </StyledActionsTableCell>
    </TableRow>
  );
}