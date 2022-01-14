import { FormikComputedProps, FormikHandlers, FormikHelpers, FormikState } from 'formik';
import { FormOnChangeEvent } from 'lib/entities/DefaultEntityBehavior';
import { PropertySpec } from 'lib/services/api/ParsedApiSpecInterface';
import { StyledFieldsetRoot, StyledFieldset } from './CustomComponentWrapper.styles';

export enum CustomFunctionComponentContext {
    write = "write",
    read = "read",
}

export interface PropertyCustomFunctionComponentProps<FormikValues> {
    _context?: CustomFunctionComponentContext,
    _columnName: string,
    formik: FormikState<FormikValues> & FormikComputedProps<FormikValues> & FormikHelpers<FormikValues> & FormikHandlers,
    changeHandler: (event: FormOnChangeEvent) => void,
    property: PropertySpec,
    disabled: boolean,
    hasChanged: boolean,
}

export type PropertyCustomFunctionComponent<T extends PropertyCustomFunctionComponentProps<any>> = React.FunctionComponent<T>;

interface CustomComponentWrapperProps {
    property: PropertySpec,
    hasChanged: boolean,
    children: JSX.Element,
}

export const CustomComponentWrapper: React.FunctionComponent<CustomComponentWrapperProps> =
    (props): JSX.Element => {
        const { property, hasChanged } = props;

        return (
            <StyledFieldsetRoot label={property.label} hasChanged={hasChanged}>
                <StyledFieldset label={property.label}>
                    {props.children}
                </StyledFieldset>
            </StyledFieldsetRoot>
        );
    }

const withCustomComponentWrapper =
    function <V, T extends PropertyCustomFunctionComponentProps<any> = PropertyCustomFunctionComponentProps<V>>(InnerComponent: React.FunctionComponent<any>): PropertyCustomFunctionComponent<T> {

        const displayName = `withRowData(${InnerComponent.displayName || InnerComponent.name})`;
        const WrappedComponent: React.FunctionComponent<any> = (props: PropertyCustomFunctionComponentProps<unknown>): JSX.Element => {

            const { property, hasChanged } = props;

            return (
                <CustomComponentWrapper property={property} hasChanged={hasChanged}>
                    <InnerComponent {...props} />
                </CustomComponentWrapper>
            );

        };
        WrappedComponent.displayName = displayName;

        return WrappedComponent;
    }

export default withCustomComponentWrapper;