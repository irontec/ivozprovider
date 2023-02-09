import FormatListBulletedIcon from '@mui/icons-material/FormatListBulleted';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { MatchListProperties } from './MatchListProperties';
import selectOptions from './SelectOptions';

const properties: MatchListProperties = {
  name: {
    label: _('Name'),
  },
};

const matchList: EntityInterface = {
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
  selectOptions: (props, customProps) => {
    return selectOptions(props, customProps);
  },
};

export default matchList;
