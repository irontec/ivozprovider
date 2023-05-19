import { isEntityItem } from '@irontec/ivoz-ui';
import DeleteRowButton from '@irontec/ivoz-ui/components/List/Content/CTA/DeleteRowButton';
import EditRowButton from '@irontec/ivoz-ui/components/List/Content/CTA/EditRowButton';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import FormatListBulletedIcon from '@mui/icons-material/FormatListBulleted';

import { MatchListProperties } from './MatchListProperties';

const properties: MatchListProperties = {
  name: {
    label: _('Name'),
  },
};

export const ChildDecorator: ChildDecoratorType = (props) => {
  const { routeMapItem, row, entityService } = props;

  if (
    isEntityItem(routeMapItem) &&
    routeMapItem.entity.iden === MatchList.iden
  ) {
    const isDeletePath = routeMapItem.route === `${MatchList.path}/:id`;
    const isUpdatePath = routeMapItem.route === `${MatchList.path}/:id/update`;

    if (row.generic) {
      if (isDeletePath) {
        return (
          <DeleteRowButton
            disabled={true}
            row={row}
            entityService={entityService}
          />
        );
      }

      if (isUpdatePath) {
        return <EditRowButton disabled={true} row={row} path={''} />;
      }
    }
  }

  return DefaultChildDecorator(props);
};

const MatchList: EntityInterface = {
  ...defaultEntityBehavior,
  icon: FormatListBulletedIcon,
  iden: 'MatchList',
  title: _('Match List', { count: 2 }),
  path: '/match_lists',
  properties,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'MatchLists',
  },
  toStr: (item: MatchListProperties) => {
    return (item.name as string) || '';
  },
  ChildDecorator,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
};

export default MatchList;
