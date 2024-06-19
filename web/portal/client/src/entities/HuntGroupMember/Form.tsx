import { EntityValue } from '@irontec/ivoz-ui';
import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
  Form as DefaultEntityForm,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { useFormHandler } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form/useFormHandler';
import useParentRow from '@irontec/ivoz-ui/hooks/useParentRow';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { useStoreState } from 'store';

import huntGroup from '../HuntGroup/HuntGroup';
import { HuntGroupPropertyList } from '../HuntGroup/HuntGroupProperties';
import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element | null => {
  const { entityService, row, match, initialValues } = props;

  const formik = useFormHandler(props);
  const values = formik.values;
  const edit = props.edit || false;
  const create = props.create || false;

  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

  if (create) {
    initialValues.numberCountry = aboutMe?.defaultCountryId ?? null;
  }

  const readOnlyProperties = {
    routeType: edit,
  };

  const parentRow = useParentRow<HuntGroupPropertyList<EntityValue>>({
    parentEntity: huntGroup,
    parentId: values.client,
  });

  if (!parentRow) {
    return null;
  }

  const strategy = parentRow.strategy as string;
  const showPriority = ['linear', 'roundRobin'].includes(strategy);
  const isRingAll = strategy === 'ringAll';

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
      fields: [!isRingAll && 'timeoutTime', showPriority && 'priority'],
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
