import { PropertyList } from '@irontec/ivoz-ui';
import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';
import { useFormHandler } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form/useFormHandler';
import _ from '@irontec/ivoz-ui/services/translations/translate';

import { foreignKeyGetter } from './ForeignKeyGetter';
import { useCarriers } from './hooks/useCarriers';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match, properties } = props;
  const edit = props.edit || false;
  let fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });
  const formik = useFormHandler(props);
  const routingMode = formik.values.routingMode;
  const carriers = useCarriers(routingMode);

  if (edit) {
    const newProperties = { ...properties };
    newProperties.routingMode = {
      ...newProperties.routingMode,
      readOnly: true,
    };

    entityService.replaceProperties(newProperties as PropertyList);
  }

  fkChoices = {
    ...fkChoices,
    carrierIds: carriers,
  };

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: '',
      fields: ['company', 'routingTag'],
    },
    {
      legend: _('Call destination'),
      fields: ['type', 'routingPattern', 'routingPatternGroup'],
    },
    {
      legend: _('Outgoing route'),
      fields: ['routingMode', 'carrier', 'carrierIds', edit && 'stopper'],
    },
    {
      legend: _('Failover and load-balancing'),
      fields: ['priority', 'weight'],
    },
    edit && {
      legend: _('Numeric transformation', { count: 1 }),
      fields: ['prefix', 'forceClid', 'clidCountry', 'clid'],
    },
  ];

  return (
    <DefaultEntityForm
      {...props}
      formik={formik}
      fkChoices={fkChoices}
      groups={groups}
    />
  );
};

export default Form;
