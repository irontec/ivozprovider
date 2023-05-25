import {
  EntityFormProps,
  FieldsetGroups,
  Form as DefaultEntityForm,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';

const Form = (props: EntityFormProps): JSX.Element => {
  const groups: Array<FieldsetGroups | false> = [
    {
      legend: '',
      fields: ['name', 'regExp'],
    },
  ];

  return <DefaultEntityForm {...props} groups={groups} />;
};

export default Form;
