import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const Form = (props: EntityFormProps): JSX.Element => {
  const { row } = props;

  const isDefaultApplicationServerSet = row?.id === 0;

  const readOnlyProperties = {
    name: isDefaultApplicationServerSet,
    distributeMethod: isDefaultApplicationServerSet,
    description: isDefaultApplicationServerSet,
  };

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Main'),
      fields: ['name', 'distributeMethod', 'description', 'applicationServers'],
    },
  ];

  return (
    <DefaultEntityForm
      {...props}
      readOnlyProperties={readOnlyProperties}
      groups={groups}
    />
  );
};

export default Form;
