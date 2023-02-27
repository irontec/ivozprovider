import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';

const Form = (props: EntityFormProps): JSX.Element => {
  const DefaultEntityForm = defaultEntityBehavior.Form;

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: '',
      fields: ['disabled', 'weight', 'url', 'description'],
    },
  ];

  return <DefaultEntityForm {...props} groups={groups} />;
};

export default Form;
