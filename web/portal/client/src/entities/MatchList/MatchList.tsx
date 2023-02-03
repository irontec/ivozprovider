import FormatListBulletedIcon from '@mui/icons-material/FormatListBulleted';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { MatchListProperties } from './MatchListProperties';
import selectOptions from './SelectOptions';
import { isEntityItem } from '@irontec/ivoz-ui';

const properties: MatchListProperties = {
  name: {
    label: _('Name'),
  },
};

export const ChildDecorator: ChildDecoratorType = (props) => {
  const { routeMapItem, row } = props;

  if (
    isEntityItem(routeMapItem) &&
    routeMapItem.entity.iden === MatchList.iden
  ) {
    const isDeletePath = routeMapItem.route === `${MatchList.path}/:id`;
    const isUpdatePath = routeMapItem.route === `${MatchList.path}/:id/update`;
    if ((isDeletePath || isUpdatePath) && row.generic) {
      return null;
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
  selectOptions: (props, customProps) => {
    return selectOptions(props, customProps);
  },
};

export default MatchList;
