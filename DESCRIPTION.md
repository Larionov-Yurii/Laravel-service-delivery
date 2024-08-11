Description of the service delivery system architecture taking into account scalability and the possibility of future improvements.

1. The system has a modular architecture that allows integrating new couriers, expanding notification channels and adding additional functions as required by the client's needs.
2. The system is built around the CourierInterface, which standardizes the method for sending delivery data. The BaseCourier class implements this interface and provides shared functionality for all couriers.
3. Each courier service (NovaPoshta, UkrPoshta, Justin) is implemented as a separate class extending BaseCourier. This allows easy addition of new couriers by simply creating a new class.
4. In case of a delivery failure, notifications are sent via email and SMS (if the recipient's phone number is available).
5. The system uses Laravel's service providers to bind the CourierInterface to the appropriate courier class, ensuring that the correct implementation is used at runtime.
