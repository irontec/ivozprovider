import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';

const Form = (props: EntityFormProps): JSX.Element => {
  const DefaultEntityForm = defaultEntityBehavior.Form;

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: '',
      fields: ['name', 'url'],
    },
    {
      legend: '',
      fields: ['klearTheme', 'logo'],
    },
  ];

  return <DefaultEntityForm {...props} groups={groups} />;
};

export default Form;
