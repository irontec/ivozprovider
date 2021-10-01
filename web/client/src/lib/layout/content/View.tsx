import { useState } from 'react';
import { withRouter } from "react-router-dom";
import EntityService from 'lib/services/entity/EntityService';
import EntityInterface from 'lib/entities/EntityInterface';
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
      <EntityView {...props} row={parsedData} />
    </div>
  )
};

export default withRouter<any, any>(
  withRowData(
    View
  )
);
