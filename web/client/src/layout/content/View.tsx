import { useState } from 'react';
import { withRouter } from "react-router-dom";
import { makeStyles } from '@material-ui/core';
import EntityService from 'services/Entity/EntityService';
import EntityInterface from 'entities/EntityInterface';
import withRowData from './withRowData';

interface ViewProps extends EntityInterface {
  entityService: EntityService,
  history: any,
  match: any,
  row: any,
  View: any,
}

const View: any = (props: ViewProps) => {

  const { View: EntityView, row, entityService, foreignKeyResolver } = props;
  const classes = useStyles();
  const [parsedData, setParsedData] = useState<any>({});
  const [foreignKeysResolved, setForeignKeysResolved] = useState<boolean>(false);

  foreignKeyResolver(row, entityService)
    .then((data: any) => {
      setParsedData(data);
      setForeignKeysResolved(true);
    });

  if (!foreignKeysResolved) {
    return null;
  }

  return (
    <div>
      <EntityView {...props} classes={classes} row={parsedData} />
    </div>
  )
};

const useStyles = makeStyles((theme: any) => ({
  dropDown: {
    minWidth: '250px'
  }
}));

export default withRouter<any, any>(
  withRowData(
    View
  )
);
