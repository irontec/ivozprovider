import defaultEntityBehavior, { EntityFormProps } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;

    return (<DefaultEntityForm {...props} />);
}

export default Form;