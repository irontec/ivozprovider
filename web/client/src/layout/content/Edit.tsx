import { useState, useEffect } from 'react';
import { withRouter } from "react-router-dom";
import EntityService from 'services/Entity/EntityService';
import EntityInterface from 'entities/EntityInterface';
import EditForm from './EditForm';
import { useStoreActions } from 'easy-peasy';

interface EditProps extends EntityInterface {
  entityService: EntityService,
  history:any,
  match:any
}

const Edit = (props: EditProps) => {

  const { match } = props;
  const { entityService }: {entityService: EntityService } = props;

  const entityId = match.params.id;

  const [loading, setLoading] = useState(true);
  const [row, setRow] = useState({});

  const apiGet = useStoreActions((actions:any) => {
      return actions.api.get
  });

  useEffect(
    () => {

      let umounted:boolean = false;
      if (loading) {

        const itemPath = entityService.getItemPath();
        if (!itemPath) {
          throw new Error('Unknown item path');
        }

        apiGet({
          path: itemPath.replace('{id}', entityId),
          params: {},
          successCallback: async (data: any) => {

            if (umounted) {
              return;
            }

            setRow(data);
            setLoading(false);
          }
        });
      }

      return function umount() {
        umounted = true;
      };
    },
    [loading, entityId, entityService, apiGet]
  );

  if (loading) {
    return null;
  }

  return (
    <EditForm row={row} {...props} />
  )
};

export default withRouter<any, any>(Edit);
