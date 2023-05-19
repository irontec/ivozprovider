import {
  EntityFormProps,
  Form as DefaultEntityForm,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';

const Form = (props: EntityFormProps): JSX.Element => {
  return <DefaultEntityForm {...props} />;
};

export default Form;
