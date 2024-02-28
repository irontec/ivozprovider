import { PropertyList } from '@irontec/ivoz-ui';
import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';
import _ from '@irontec/ivoz-ui/services/translations/translate';

import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match, properties, initialValues } = props;
  const edit = props.edit || false;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  if (edit) {
    const newProperties = { ...properties };
    newProperties.routingMode = {
      ...newProperties.routingMode,
      readOnly: true,
    };

    entityService.replaceProperties(newProperties as PropertyList);
  }

  if ('object' === typeof initialValues.carrier) {
    initialValues.carrier = initialValues.carrier.id;
  }

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

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
