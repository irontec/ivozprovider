import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';

const Form = (props: EntityFormProps): JSX.Element => {
  const groups: Array<FieldsetGroups | false> = [
    {
      legend: '',
      fields: ['name', 'url'],
    },
    {
      legend: '',
      fields: ['color', 'logo'],
    },
  ];

  return <DefaultEntityForm {...props} groups={groups} />;
};

export default Form;
