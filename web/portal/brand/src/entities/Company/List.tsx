import { ListContentProps } from '@irontec/ivoz-ui/components/List/Content/ListContent';
import DefaultEntityList from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import useCancelToken from '@irontec/ivoz-ui/hooks/useCancelToken';
import { useEffect } from 'react';
import { useStoreActions, useStoreState } from 'store';

import WebPortal from '../WebPortal/WebPortal';

const List = (props: ListContentProps): JSX.Element => {
  const rows = useStoreState((store) => store.list.rows);
  const getAction = useStoreActions((actions) => actions.api.get);
  const setCustomData = useStoreActions(
    (actions) => actions.list.setCustomData
  );
  const [, cancelToken] = useCancelToken();

  useEffect(() => {
    if (rows.length === 0) {
      setCustomData([]);

      return;
    }
    getAction({
      path: `${WebPortal.path}?_order[id]=ASC`,
      params: {
        urlType: 'admin',
        _pagination: false,
      },
      cancelToken: cancelToken,
      successCallback: async (response) => {
        setCustomData(response);
      },
    });
  }, []);

  return <DefaultEntityList.List {...props} />;
};

export default List;
