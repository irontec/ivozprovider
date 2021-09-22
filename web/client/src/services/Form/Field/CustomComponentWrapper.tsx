import {
    PropertyCustomComponent, propertyCustomComponentProps, PropertySpec
} from 'services/Api/ParsedApiSpecInterface';
import { StyledFieldsetRoot, StyledFieldset } from './CustomComponentWrapper.styles';

interface CustomComponentWrapperProps extends propertyCustomComponentProps {
    property: PropertySpec,
    children: React.ReactElement | React.ReactElement[],
};

const CustomComponentWrapper: PropertyCustomComponent<CustomComponentWrapperProps> = (props: CustomComponentWrapperProps) => {
    const { property } = props;

    return (
        <StyledFieldsetRoot label={property.label}>
            <StyledFieldset label={property.label}>
                {props.children}
            </StyledFieldset>
        </StyledFieldsetRoot>
    );
}

export default CustomComponentWrapper;