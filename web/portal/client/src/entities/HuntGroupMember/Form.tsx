import { EntityValue } from '@irontec/ivoz-ui';
import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { useFormHandler } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form/useFormHandler';
import useParentRow from '@irontec/ivoz-ui/hooks/useParentRow';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { HuntGroupPropertyList } from '../HuntGroup/HuntGroupProperties';
import huntGroup from '../HuntGroup/HuntGroup';
import { foreignKeyGetter } from './foreignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element | null => {
  const { entityService, row, match } = props;

  const formik = useFormHandler(props);
  const values = formik.values;
  const edit = props.edit || false;
  const create = props.create || false;

  const DefaultEntityForm = defaultEntityBehavior.Form;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const readOnlyProperties = {
    routeType: edit,
  };

  const parentRow = useParentRow<HuntGroupPropertyList<EntityValue>>({
    parentEntity: huntGroup,
    match,
    parentId: values.client,
  });

  if (!parentRow) {
    return null;
  }

  const strategy = parentRow.strategy as string;
  const showPriority = ['linear', 'roundRobin'].includes(strategy);

  const groups: Array<FieldsetGroups> = [
    {
      legend: _('Routing configuration'),
      fields: [
        'routeType',
        create && 'user',
        create && 'numberCountry',
        create && 'numberValue',
        edit && 'target',
      ],
    },
    {
      legend: _('Entry information'),
      fields: ['timeoutTime', showPriority && 'priority'],
    },
  ];

  return (
    <DefaultEntityForm
      {...props}
      fkChoices={fkChoices}
      groups={groups}
      readOnlyProperties={readOnlyProperties}
      formik={formik}
    />
  );
};

export default Form;
