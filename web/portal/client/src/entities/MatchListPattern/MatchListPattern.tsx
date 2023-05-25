import { EntityValue, isEntityItem } from '@irontec/ivoz-ui';
import DeleteRowButton from '@irontec/ivoz-ui/components/List/Content/CTA/DeleteRowButton';
import EditRowButton from '@irontec/ivoz-ui/components/List/Content/CTA/EditRowButton';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import { PartialPropertyList } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import FormatListNumberedIcon from '@mui/icons-material/FormatListNumbered';
import { useStoreState } from 'store';

import { MatchListPropertyList } from '../MatchList/MatchListProperties';
import matchValue from './Field/MatchValue';

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
  const { routeMapItem, row, entityService } = props;
  const parentRow = useStoreState(
    (state) =>
      state.list.parentRow as
        | MatchListPropertyList<EntityValue>
        | null
        | undefined
  );

  const disableActions = !parentRow || parentRow?.generic === true;

  if (disableActions && isEntityItem(routeMapItem)) {
    const isDeletePath = routeMapItem.route === `${MatchListPattern.path}/:id`;
    const isUpdatePath =
      routeMapItem.route === `${MatchListPattern.path}/:id/update`;

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

    return null;
  }

  return DefaultChildDecorator(props);
};

const MatchListPattern: EntityInterface = {
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
  ChildDecorator,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default MatchListPattern;
