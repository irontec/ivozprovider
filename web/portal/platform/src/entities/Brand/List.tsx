import { ListContentProps } from '@irontec/ivoz-ui/components/List/Content/ListContent';
import DefaultEntityList from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import useCancelToken from '@irontec/ivoz-ui/hooks/useCancelToken';
import WebPortal from 'entities/WebPortal/WebPortal';
import { useEffect } from 'react';
import { useStoreActions, useStoreState } from 'store';

const List = (props: ListContentProps): JSX.Element => {
  const rows = useStoreState((store) => store.list.rows);
  const getAction = useStoreActions((actions) => actions.api.get);
  const setCustomData = useStoreActions(
    (actions) => actions.list.setCustomData
  );
  const [, cancelToken] = useCancelToken();

  useEffect(() => {
    const brandIds = rows.map((brand) => brand.id);

    getAction({
      path: `${WebPortal.path}?_order[id]=ASC`,
      params: {
        brand: brandIds,
        urlType: 'brand',
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
