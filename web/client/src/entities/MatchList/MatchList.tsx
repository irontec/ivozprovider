import FormatListBulletedIcon from '@mui/icons-material/FormatListBulleted';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import { MatchListProperties } from './MatchListProperties';
import selectOptions from './SelectOptions';

const properties: MatchListProperties = {
    'name': {
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
    toStr: (item: MatchListProperties) => { return item.name as string || ''; },
    selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
};

export default matchList;