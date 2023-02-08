import FormatListNumberedIcon from '@mui/icons-material/FormatListNumbered';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import Form from './Form';
import { PartialPropertyList } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { useStoreState } from 'store';
import foreignKeyResolver from './foreignKeyResolver';
import selectOptions from './SelectOptions';
import matchValue from './Field/MatchValue';
import { MatchListPropertyList } from '../MatchList/MatchListProperties';

const properties: PartialPropertyList = {
  matchList: {
    label: _('Match List'),
  },
  description: {
    label: _('Description'),
  },
  type: {
    label: _('Type'),
    enum: {
      number: _('Number'),
      regexp: _('Regular Expression'),
    },
    visualToggle: {
      number: {
        show: ['numberCountry', 'numbervalue'],
        hide: ['regexp'],
      },
      regexp: {
        show: ['regexp'],
        hide: ['numberCountry', 'numbervalue'],
      },
    },
  },
  regexp: {
    label: _('Regular Expression'),
  },
  numberCountry: {
    label: _('Country'),
  },
  numbervalue: {
    label: _('Number'),
  },
  matchValue: {
    label: _('Match Value'),
    component: matchValue,
  },
};

const columns = ['type', 'matchValue', 'description'];

export const ChildDecorator: ChildDecoratorType = (props) => {
  const parent = useStoreState(
    (state) =>
      state.list.parentRow as MatchListPropertyList<string | number | boolean>
  );

  if (parent?.generic === true) {
    return null;
  }

  return DefaultChildDecorator(props);
};

const matchListPattern: EntityInterface = {
  ...defaultEntityBehavior,
  icon: FormatListNumberedIcon,
  iden: 'MatchListPattern',
  title: _('Match List Pattern', { count: 2 }),
  path: '/match_list_patterns',
  properties,
  columns,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'MatchListPatterns',
  },
  Form,
  ChildDecorator,
  foreignKeyResolver,
  selectOptions: (props, customProps) => {
    return selectOptions(props, customProps);
  },
};

export default matchListPattern;
