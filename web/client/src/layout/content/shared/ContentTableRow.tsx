/* eslint-disable no-script-url */

import React, { useState } from 'react';
import {
  TableCell, TableRow, Tooltip, makeStyles
} from '@material-ui/core';
import { Link } from "react-router-dom";
import EditIcon from '@material-ui/icons/Edit';
import DeleteIcon from '@material-ui/icons/Delete';
import CheckBoxIcon from '@material-ui/icons/CheckBox';
import CheckBoxOutlineBlankIcon from '@material-ui/icons/CheckBoxOutlineBlank';
import ConfirmDialog from './ConfirmDialog';
import EntityService from 'services/Entity/EntityService';
import { useStoreActions } from 'easy-peasy';

interface propsType {
  entityService: EntityService,
  row: any,
  path: string,
  setLoading: Function
}

export default function ContentTableRow(props: propsType) {

  const classes = useStyles();
  const {entityService, row, path, setLoading} = props;

  const columns = entityService.getCollectionColumns();
  const acl = entityService.getAcls();
  const ListDecorator = entityService.getListDecorator();
  const RowActions: React.FunctionComponent | any = entityService.getRowActions();

  const [showDelete, setShowDelete] = useState(false);

  const apiDelete = useStoreActions((actions:any) => {
    return actions.api.delete
  });

  const handleHideDelete = (event: any) => {
    setShowDelete(false);
  };

  const handleDelete = async (event: any) => {

    const path = entityService.getDeletePath();
    if (!path) {
        throw new Error('Unknown delete path');
    }

    event.preventDefault();
    await apiDelete({
        path: path.replace('{id}', row.id)
    });
    setShowDelete(false);
    setLoading(true);
  };

  return (
    <TableRow hover key={row.id}>
      {Object.keys(columns).map((key: string) => {
        const value = row[key];
        const isBoolean = typeof value === "boolean";
        let response = value;

        if (isBoolean && value) {
          response = <CheckBoxIcon className={classes.boolIcon} />;
        } else if (isBoolean) {
          response = <CheckBoxOutlineBlankIcon className={classes.boolIcon} />;
        } else if (row[`${key}Link`]) {
            response =
              <Link
                className={classes.fkLink}
                to={row[`${key}Link`]}
              >
                {value}
              </Link>
        } else {

          response = <ListDecorator field={key} row={row} />
        }

        return <TableCell key={key}>{response}</TableCell>;
      })}
      <TableCell key="actions" className={classes.actionCell}>
        {acl.update && <Tooltip title="Edit" placement="bottom">
          <Link to={`${path}/${row.id}/update`} className={classes.link}>
            <EditIcon />
          </Link>
        </Tooltip>}
        &nbsp;
        {acl.delete && <Tooltip title="Delete" placement="bottom">
          <DeleteIcon
            onClick={() => setShowDelete(true)}
            className={classes.delete}
          />
        </Tooltip>}
        {acl.delete && <ConfirmDialog
          text={`You're about to remove item #${row.id}`}
          open={showDelete}
          handleClose={handleHideDelete}
          handleApply={handleDelete}
        />}
        {<RowActions row={row} styles={classes.link} />}
      </TableCell>
    </TableRow>
  );
}

const useStyles = makeStyles((theme: any) => ({
  link: {
    textDecoration: 'none',
    color: 'inherit',
    cursor: 'pointer',
  },
  fkLink: {
    color: 'inherit',
    cursor: 'pointer',
  },
  delete: {
    cursor: 'pointer'
  },
  actionCell: {
    textAlign: 'right'
  },
  boolIcon: {
    color: '#aaa'
  }
}));