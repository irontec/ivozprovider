import { isEntityItem } from '@irontec/ivoz-ui';
import { ListContentProps } from '@irontec/ivoz-ui/components/List/Content/ListContent';
import DefaultEntityList from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import useCancelToken from '@irontec/ivoz-ui/hooks/useCancelToken';
import { useEffect } from 'react';
import { useStoreActions, useStoreState } from 'store';

import RatingProfile from '../RatingProfile/RatingProfile';
import WebPortal from '../WebPortal/WebPortal';

const List = (props: ListContentProps): JSX.Element => {
  const rows = useStoreState((store) => store.list.rows);
  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);
  const getAction = useStoreActions((actions) => actions.api.get);
  const setCustomData = useStoreActions(
    (actions) => actions.list.setCustomData
  );
  const [, cancelToken] = useCancelToken();

  const filteredEntities = props.childEntities.filter((item) => {
    const isBillingFeature =
      isEntityItem(item) && item.entity.iden === RatingProfile.iden;
    if (!isBillingFeature) {
      return true;
    }

    return aboutMe?.features.includes('billing');
  });

  useEffect(() => {
    if (rows.length === 0) {
      setCustomData([]);

      return;
    }
    getAction({
      path: `${WebPortal.path}?_order[id]=ASC`,
      params: {
        urlType: 'user',
        _pagination: false,
      },
      cancelToken: cancelToken,
      successCallback: async (response) => {
        setCustomData(response);
      },
    });
  }, []);

  return <DefaultEntityList.List {...props} childEntities={filteredEntities} />;
};

export default List;
